<?php

namespace App\Providers;

use App\Models\Attendee;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Event;
use App\Models\Order;
use App\Models\TicketType;
use App\Policies\AttendeePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CouponPolicy;
use App\Policies\EventPolicy;
use App\Policies\OrderPolicy;
use App\Policies\TicketTypePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Event::class => EventPolicy::class,
        Order::class => OrderPolicy::class,
        TicketType::class => TicketTypePolicy::class,
        Attendee::class => AttendeePolicy::class,
        Category::class => CategoryPolicy::class,
        Coupon::class => CouponPolicy::class
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::before(function ($user, $ability){
            return $user->hasRole('super-admin') ? true : false;
        });
    }
}
