<?php


namespace App\Contracts\Dashboard;


use Illuminate\Support\Collection;

interface Dashboard
{
    /**
     * Get applicant metrics for the dashboard.
     *
     * @param Collection $applicants
     * @return array
     */
    public function getApplicantMetrics(Collection $applicants);

    /**
     * Get the job metrics for the last 6 months to display on the dashboard.
     *
     * @param Collection $workers
     * @return array
     */
    public function getWorkerMetrics(Collection $workers);

    /**
     * Get the job metrics for the last 6 months to display on the dashboard.
     *
     * @param Collection $jobs
     * @return array
     */
    public function getJobMetrics(Collection $jobs);

    /**
     * Get the hiring rate for a business
     *
     * @param Collection $applicants
     * @return array
     */
    public function getHiringRate(Collection $applicants);


}
