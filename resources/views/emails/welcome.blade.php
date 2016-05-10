
Hi {{ $name or 'there' }},

Thanks for signing up!

<p>
    I just need you to <a href="{{ url('register/confirm/'.$token) }}">
         confirm your email address </a> very quick!
</p>


Thanks,
Tigran
