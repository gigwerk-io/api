<?php


namespace App\Dashboard;


use App\Contracts\Dashboard\Dashboard;
use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\MarketplaceJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardProvider implements Dashboard
{
    /**
     * Get the applicant metrics for the last 6 months to display on the dashboard.
     *
     * @param Collection $applicants
     * @return array
     */
    public function getApplicantMetrics(Collection $applicants)
    {
        $months = [];
        $dataset = [];
        $total = $applicants->count();

        for ($i = 6; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('M');
        }

        foreach ($months as $month) {
            $filteredApplicants = $applicants->filter(function (Application $application) use ($month){
                return Carbon::parse($month)->month == Carbon::parse($application->created_at)->month;
            });

            $dataset[] = $filteredApplicants->count();
        }

        $old = $dataset[0] === 0 ? 1: $dataset[0];
        $new = $dataset[6] === 0 ? 1: $dataset[6];
        $percentage = (1 - $old / $new);

        return [
            'dataset' => $dataset,
            'labels' => $months,
            'total' => $total,
            'percentage' => $percentage
        ];
    }

    /**
     * Get the job metrics for the last 6 months to display on the dashboard.
     *
     * @param Collection $workers
     * @return array
     */
    public function getWorkerMetrics(Collection $workers)
    {
        $months = [];
        $dataset = [];
        $total = $workers->count();

        for ($i = 6; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('M');
        }

        foreach ($months as $month) {
            $filteredWorkers = $workers->filter(function (User $application) use ($month){
                return Carbon::parse($month)->month == Carbon::parse($application->created_at)->month;
            });

            $dataset[] = $filteredWorkers->count();
        }

        $old = $dataset[0] === 0 ? 1: $dataset[0];
        $new = $dataset[6] === 0 ? 1: $dataset[6];
        $percentage = (1 - $old / $new);

        return [
            'dataset' => $dataset,
            'labels' => $months,
            'total' => $total,
            'percentage' => $percentage
        ];
    }

    /**
     * Get the job metrics for the last 6 months to display on the dashboard.
     *
     * @param Collection $jobs
     * @return array
     */
    public function getJobMetrics(Collection $jobs)
    {
        $months = [];
        $dataset = [];
        $total = $jobs->count();

        for ($i = 6; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('M');
        }

        foreach ($months as $month) {
            $filteredJobs = $jobs->filter(function (MarketplaceJob $job) use ($month){
                return Carbon::parse($month)->month == Carbon::parse($job->created_at)->month;
            });

            $dataset[] = $filteredJobs->count();
        }

        $old = $dataset[0] === 0 ? 1: $dataset[0];
        $new = $dataset[6] === 0 ? 1: $dataset[6];
        $percentage = (1 - $old / $new);

        return [
            'dataset' => $dataset,
            'labels' => $months,
            'total' => $total,
            'percentage' => $percentage
        ];
    }

    /**
     * Get the hiring rate for a business
     *
     * @param Collection $applicants
     * @return array
     */
    public function getHiringRate(Collection $applicants)
    {
        $months = [];
        $dataset = [];
        $approved = $applicants->where('status', '=', ApplicationStatus::APPROVED())->count();
        try {
            $total = $approved/$applicants->count();
        }catch (\Exception $exception) {
            $total = 0;
        }


        for ($i = 6; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('M');
        }

        foreach ($months as $month) {
            $filteredApplicants = $applicants->filter(function (Application $application) use ($month){
                return Carbon::parse($month)->month == Carbon::parse($application->created_at)->month;
            });
            $filteredApproved = $filteredApplicants->where('status', '=', ApplicationStatus::APPROVED())->count();

            try {
                $dataset[] = $filteredApproved/$filteredApplicants->count();
            }catch (\Exception $exception) {
                $dataset[] = 0;
            }

        }

        $old = $dataset[0] === 0 ? 1: $dataset[0];
        $new = $dataset[6] === 0 ? 1: $dataset[6];
        $percentage = (1 - $old / $new);

        return [
            'dataset' => $dataset,
            'labels' => $months,
            'total' => $total,
            'percentage' => $percentage
        ];
    }
}
