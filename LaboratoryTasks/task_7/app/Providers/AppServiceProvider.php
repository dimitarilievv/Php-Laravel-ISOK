<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Feedback;
use App\Observers\CourseObserver;
use App\Observers\FeedbackObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register model observers
        Feedback::observe(FeedbackObserver::class);
        Course::observe(CourseObserver::class);
    }
}
