<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;

ga('create', 'UA-81331019-1', 'auto');

ga('require', 'cleanUrlTracker', {
  queryDimensionIndex: 1,
  stripQuery: true,
  trailingSlash: 'remove',
});

ga('require', 'outboundFormTracker');
ga('require', 'outboundLinkTracker');
ga('require', 'pageVisibilityTracker', {
  sessionTimeout: 30, // minutes; must be same as setting in Google Analytics
});
ga('require', 'socialWidgetTracker');
ga('require', 'urlChangeTracker');
ga('require', 'maxScrollTracker');


ga('send', 'pageview');
</script>

@if (env('APP_ENV') == 'production')
    @include('javascripts.mixpanel_production')
@else
    @include('javascripts.mixpanel_development')
@endif
