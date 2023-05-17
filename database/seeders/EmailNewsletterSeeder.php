<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailNewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_newsletters')->insert([
            'title' => 'Newsletter Subscription',
            'subject' => 'Welcome to our organization',
            'action' => 'NEWSLETTER_SUBSCRIPTION_CUSTOMER',
            'body' => 'Thanks you for subscribing to our newsletter'
        ]);
        DB::table('email_newsletters')->insert([
            'title' => 'Newsletter Subscription',
            'subject' => 'New Subscription',
            'action' => 'NEWSLETTER_SUBSCRIPTION_ADMIN',
            'body' => 'The with email {{$email}} has subscriber to our newsletter.'
        ]);
    }
}
