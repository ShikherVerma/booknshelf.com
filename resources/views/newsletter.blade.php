@extends('layouts.app')

@section('content')

    <section class="section">
      <div class="container">
        <h1 class="title is-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" class="heroicon-envelope-check heroicon heroicon-lg">
            <rect class="heroicon-envelope-check-body heroicon-component-fill" x="1" y="13" width="98" height="58" rx="3"></rect>
            <path class="heroicon-envelope-check-sides heroicon-component-accent heroicon-component-fill" d="M97.95 15.557c.033.143.05.29.05.443v52c0 .152-.017.3-.05.443L94 65.44V18.56l3.95-3.003zM2.05 68.443C2.016 68.3 2 68.153 2 68V16c0-.152.017-.3.05-.443L6 18.56v46.88l-3.95 3.003z"></path>
            <circle class="heroicon-envelope-check-circle heroicon-component-accent heroicon-component-fill" cx="82" cy="71" r="18"></circle>
            <path class="heroicon-envelope-check-symbol heroicon-component-fill" d="M78.293 72.465l-2.172-2.172-.706-.707-.707.707-1.414 1.414-.707.707.707.707 5 5 .707.71.707-.71 10-10 .707-.706-.707-.707-1.414-1.414-.707-.707-.707.707-7.173 7.17-.707.71z"></path>
            <path class="heroicon-shadows" d="M0 14l46.815 35.58c1.76 1.336 4.614 1.334 6.37 0L100 14 52.997 55.363c-1.655 1.456-4.334 1.46-5.994 0L0 14z"></path>
            <path class="heroicon-outline" fill-rule="nonzero" d="M99.885 68.955c.076.67.115 1.354.115 2.045 0 9.94-8.06 18-18 18-9.606 0-17.454-7.524-17.973-17H4c-2.21 0-4-1.79-4-4V16c0-2.21 1.79-4 4-4h92c2.21 0 4 1.79 4 4v52c0 .33-.04.65-.115.955zm-96.48.955c.188.06.388.09.595.09h60.027c.4-7.32 5.174-13.473 11.752-15.896L61.504 43.256 52.42 50.16c-1.43 1.088-3.41 1.088-4.84 0l-9.085-6.904L3.418 69.914l-.013-.004zM78.17 53.408C79.403 53.14 80.684 53 82 53c4.142 0 7.958 1.4 11 3.75V19.32L63.158 42l15.01 11.408zM94 57.583c1.627 1.457 2.988 3.205 4 5.163V16c0-.152-.017-.3-.05-.443L94 18.56V57.583zM4 14c-.202 0-.398.03-.582.086L48.79 48.568c.715.544 1.705.544 2.42 0l45.372-34.482C96.398 14.03 96.202 14 96 14H4zm-1.95 1.548c-.032.145-.05.297-.05.452v52c0 .152.017.3.05.442L6 65.44V18.56l-3.95-3.003v-.01zM7 64.68L36.842 42 7 19.32v45.36zM98 71c0-8.837-7.163-16-16-16s-16 7.163-16 16 7.163 16 16 16 16-7.163 16-16zm-21.88-.707l2.173 2.17.707.71.707-.71 7.172-7.17.706-.707.707.707 1.414 1.414.707.707-.707.707-10 10-.707.71-.707-.71-5-5-.707-.706.707-.707 1.414-1.414.707-.707.707.707zm3.587 3.586l-.707.706-.707-.707-2.88-2.88L74 72.414l5 5 10-10L87.586 66l-7.88 7.88zm-10.745 2.23C68.342 74.53 68 72.805 68 71c0-7.732 6.268-14 14-14v1c-7.18 0-13 5.82-13 13 0 1.652.308 3.232.87 4.686l-.908.425z"></path>
        </svg>

        </h1>
        <h1 class="title is-1">
        If you love books then you will enjoy my weekly newsletter. No spam, ever!
        </h1>
        <h1 class="title">
            I'm sending book recommendations and summaries. Free books and all sorts of book deals.
            I also love sharing my learnings from fiction books I read.
        </h1>
      </div>
    </section>

    <section id="newsletter" class="hero">
        <div class="hero-body">
            <div class="container">
                <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup" class="columns is-vcentered">
                    <div class="column is-half">
                        <form
                            action="//booknshelf.us3.list-manage.com/subscribe/post?u=a18b6a0108993df0bc58f69ca&amp;id=6c8cc6f15e"
                            method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                            class="validate" target="_blank" novalidate="novalidate">
                            <div id="mc_embed_signup_scroll">
                                <div class="control is-grouped">
                                    <div class="control has-icon is-expanded">
                                        <input type="email" value="" name="EMAIL" class="input is-large is-flat required email"
                                               id="mce-EMAIL" placeholder="Enter your email address" required=""
                                               aria-required="true">
                                        <span class="icon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </div>
                                    <div class="control">
                                        <input type="submit" value="Subscribe" name="subscribe"
                                               id="mc-embedded-subscribe" class="button is-primary is-large">
                                    </div>
                                </div>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                    <input type="text" name="b_a18b6a0108993df0bc58f69ca_6c8cc6f15e" tabindex="-1" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--End mc_embed_signup-->
            </div>
        </div>
    </section>

@endsection
