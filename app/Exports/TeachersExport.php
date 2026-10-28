<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Http\Request;

/**
 * Export teachers to Excel with optional search and email status filters.
 */
class TeachersExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * Filters for the export, including search and email status.
     */
    protected array $filters;

    /**
     * Initialize the export with optional filters.
     */
    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Build the query for exporting teachers, applying search and email status filters if provided.
     */
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        $query = User::query()
            ->where('user_type', 'teacher');

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nic', 'like', "%{$search}%");
            });
        }

        if (($this->filters['email_status'] ?? '') === 'with_email') {
            $query->whereNotNull('email')
                ->where('email', '!=', '');
        } elseif (($this->filters['email_status'] ?? '') === 'without_email') {
            $query->where(function ($q) {
                $q->whereNull('email')
                    ->orWhere('email', '');
            });
        }

        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Define the headings for the exported Excel file.
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'NIC Number',
            'Date of Birth',
            'Address',
            'First Appointment Date',
            'Current School Appointment Date',
            'Subject of Appointment',
            'Class'
        ];
    }

    /**
     * Map the user data for the exported Excel file.
     */
    public function map($user): array
    {
        return [
            $user->name,
            $user->email ?? '',
            $user->nic ?? '',
            $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-M-d') : '',
            $user->address ?? '',
            $user->first_appointment_date
                ? \Carbon\Carbon::parse($user->first_appointment_date)->format('Y-M-d')
                : '',
            $user->date_current_appointment_school
                ? \Carbon\Carbon::parse($user->date_current_appointment_school)->format('Y-M-d')
                : '',
            $user->appointment_subject ?? '',
            $user->class ?? '',
        ];
    }
}
