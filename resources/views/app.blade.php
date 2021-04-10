<!DOCTYPE html>
<html class="h-full bg-gray-200">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <title>LaraBug</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#d22651">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    @routes
</head>
<body class="font-sans text-gray-800 antialiased">
@inertia

@if(config('postmark.rebound'))
    <script>
        window.ReboundSettings = {
            publicToken: "{{ config('postmark.rebound') }}",
            email: "{{ auth()->user()->email }}",
            appearance: "alert",
            actionLabel: "Update email",
            actionUrl: "https://www.larabug.com/panel/profile",
        }
    </script>
    <script>(function (r, e, b, o, u, n, d) {
            if (r.Rebound) return;
            d = function () {
                o = "script";
                u = e.createElement(o);
                u.type = "text/javascript";
                u.src = b;
                u.async = true;
                n = e.getElementsByTagName(o)[0];
                n.parentNode.insertBefore(u, n)
            };
            if (r.attachEvent) {
                r.attachEvent("onload", d)
            } else {
                r.addEventListener("load", d, false)
            }
        })(window, document, "https://rebound.postmarkapp.com/widget/1.0");</script>
@endif
</body>
</html>
