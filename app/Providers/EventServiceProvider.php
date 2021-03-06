<?php

namespace App\Providers;

use App\Events\OrderDelivered;
use App\Events\OrderPaid;
use App\Events\OrderRefund;
use App\Events\OrderReview;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //微信授权登录
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // add your listeners (aka providers) here
            'SocialiteProviders\Weixin\WeixinExtendSocialite@handle'
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Verified::class=> [
            \App\Listeners\EmailVerified::class,
        ],
        OrderPaid::class=> [
            \App\Listeners\UpdateProductSoldCount::class,
            \App\Listeners\SendOrderPaidMail::class
        ],
        OrderDelivered::class=>[
            \App\Listeners\SendOrderDeliveredMail::class
        ],
        OrderReview::class=>[
            \App\Listeners\UpdateReviewInfo::class,
        ],
        OrderRefund::class=>[
            \App\Listeners\AgreeRefund::class,
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
