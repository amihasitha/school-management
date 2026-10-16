<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /** Which users-table column each user type signs in with. */
    private const IDENTIFIER = [
        'super_admin' => 'email',
        'teacher' => 'nic',
        'student' => 'index_number',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_type' => ['required', Rule::in(array_keys(self::IDENTIFIER))],
            // Only the identifier for the chosen type is required.
            'email' => ['required_if:user_type,super_admin', 'nullable', 'string', 'email'],
            'nic' => ['required_if:user_type,teacher', 'nullable', 'string'],
            'index_number' => ['required_if:user_type,student', 'nullable', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $type = $this->string('user_type')->toString();
        $field = self::IDENTIFIER[$type];

        $credentials = [
            $field => $this->string($field)->toString(),
            'user_type' => $type, // the account must really be of the selected type
            'password' => $this->input('password'),
        ];

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            // Show the error under the field the user actually sees.
            throw ValidationException::withMessages([
                $field => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());
        $field = self::IDENTIFIER[$this->string('user_type')->toString()] ?? 'user_type';

        throw ValidationException::withMessages([
            $field => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        $type = $this->string('user_type')->toString();
        $identifier = $this->string(self::IDENTIFIER[$type] ?? 'email')->toString();

        return Str::transliterate(Str::lower($type.'|'.$identifier).'|'.$this->ip());
    }
}