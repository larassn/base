<?php

namespace Modules\Base\Tests\Unit;

use Modules\User\Models\User;
use Tests\TestCase;

class GmailEmailCleaningTest extends TestCase
{
    /** @test */
    public function it_cleans_gmail_emails_by_removing_dots()
    {
        $user = new User();

        // Test removing dots from Gmail addresses
        $user->email = 'user.name@gmail.com';
        $this->assertEquals('username@gmail.com', $user->email);

        $user->email = 'my.email.address@gmail.com';
        $this->assertEquals('myemailaddress@gmail.com', $user->email);
    }

    /** @test */
    public function it_cleans_gmail_emails_by_removing_plus_signs()
    {
        $user = new User();

        // Test removing plus signs and everything after from Gmail addresses
        $user->email = 'user+tag@gmail.com';
        $this->assertEquals('user@gmail.com', $user->email);

        $user->email = 'email+newsletter+2024@gmail.com';
        $this->assertEquals('email@gmail.com', $user->email);
    }

    /** @test */
    public function it_combines_both_dot_and_plus_cleaning()
    {
        $user = new User();

        // Test combining both cleaning operations
        $user->email = 'user.name+tag@gmail.com';
        $this->assertEquals('username@gmail.com', $user->email);

        $user->email = 'my.email+newsletter+2024@gmail.com';
        $this->assertEquals('myemail@gmail.com', $user->email);
    }

    /** @test */
    public function it_does_not_affect_non_gmail_emails()
    {
        $user = new User();

        // Test that non-Gmail emails are not modified
        $user->email = 'user.name@example.com';
        $this->assertEquals('user.name@example.com', $user->email);

        $user->email = 'user+tag@company.org';
        $this->assertEquals('user+tag@company.org', $user->email);
    }

    /** @test */
    public function it_handles_googlemail_domain()
    {
        $user = new User();

        // Test that googlemail.com is also treated as Gmail
        $user->email = 'user.name@googlemail.com';
        $this->assertEquals('username@googlemail.com', $user->email);

        $user->email = 'email+tag@googlemail.com';
        $this->assertEquals('email@googlemail.com', $user->email);
    }

    /** @test */
    public function it_normalizes_email_case()
    {
        $user = new User();

        // Test that emails are converted to lowercase
        $user->email = 'USER.NAME@GMAIL.COM';
        $this->assertEquals('username@gmail.com', $user->email);

        $user->email = 'Email+Tag@Gmail.com';
        $this->assertEquals('email@gmail.com', $user->email);
    }
}
