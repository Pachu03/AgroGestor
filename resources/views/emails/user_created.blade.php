<!DOCTYPE html>
<html>

<head>
    <title>@lang('Wellcome')</title>
</head>

<body>
    <h1>@lang('Wellcome'), {{ $user->name }}</h1>
    <p>>@lang('Your email address is'): {{ $user->email }}</p>
    <p>@lang('Your password is'): {{ $password }}</p>
</body>

</html>
