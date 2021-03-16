# Laravel Basecamp API

An API wrapper for Basecamp 3.

## Prerequisites

### Create an integration

Visit https://launchpad.37signals.com/integrations and register your app.

### OAuth2

The Basecamp3 API only supports 3-legged authentication and makes calls on
behalf of one user. To receive an access token, you can use
[Laravel Socialite](https://github.com/laravel/socialite) with the
[37signals Socialite Driver](https://github.com/SocialiteProviders/Providers/tree/master/src/ThirtySevenSignals).
After you save the access token and the desired Basecamp3 account, you can now
create an instance of the API wrapper.

## Installation

```
composer require coopbelvedere/laravel-basecamp-api
php artisan vendor:publish --provider="Belvedere\Basecamp\BasecampServiceProvider"
```

Add a `user-agent` to identify your app in your `config/basecamp.php` file.

## Usage

Retrieve your basecamp id, base uri (href), token and refresh token and
initialize the API wrapper. Here's a basic example on the `routes/web.php`
file to get you started.

```php
Route::get('/login/basecamp', function () {
    return Socialite::driver('37signals')->redirect();
});

Route::get('/login/basecamp/callback', function () {
    $user = Socialite::driver('37signals')->user();

    Basecamp::init([
        'id' => $user->user['accounts'][0]['id'],
        'href' => $user->user['accounts'][0]['href'],
        'token' => $user->token,
        'refresh_token' => $user->refreshToken,
    ]);

    $projects = Basecamp::projects();
    dd($projects->index());
});
```

**NOTE:** You shouldn't initialize the API in the callback route, this
is only to show you what data to keep from the socialite user.


### Caching

The client uses a Laravel Filesystem cache strategy by default. You can
override this with your preferred Laravel cache store:

```php
Basecamp::setCache(Cache::store('redis'));
```

### Middlewares (optional)

You can optionally add an array of middlewares to the Guzzle Handler Stack.
Here is an example for logging a request:

```php
Basecamp::setMiddlewares([
    \GuzzleHttp\Middleware::log(
        Log::getLogger(),
        new \GuzzleHttp\MessageFormatter('{method} {uri} HTTP/{version} {req_body}')
    )
]);
```

### Event Listener

The Client also comes with a middleware which will refresh an expired access
token and automatically retry the intended endpoint. You can listen to the
`basecamp.refreshed_token` event to update the access token in your app.
The event returns 2 parameters, your basecamp user id and the new access token.

You can add something like this in your `EventServiceProvider.php` boot method:

```php
Event::listen('basecamp.refreshed_token', function ($id, $token) {
    $user = \App\User::where('basecamp_id', $id)->first();
    $user->access_token = $token->access_token;
    $user->expires_at = \Carbon\Carbon::now()->addSeconds($token->expires_in);
    $user->save();
});
```

### Pagination

Most collection of resources in Basecamp can be paginated.

```php
// Get projects.
$projects = Basecamp::projects()->index();

// Get total of projects
$projects->total();

// Save the next page link for your next request
$nextPage = $projects->nextPage();

// Call the next page of projects.
$projects = Basecamp::projects()->index($nextPage);
```

### Resources documentation

- [Attachments](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/attachments.md)
- [Campfires](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/campfires.md)
- [Chatbots](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/chatbots.md)
- [Client approvals](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/client_approvals.md)
- [Client correspondances](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/client_correspondences.md)
- [Client replies](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/client_replies.md)
- [Comments](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/comments.md)
- [Documents](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/documents.md)
- [Events](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/events.md)
- [Forwards](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/forwards.md)
- [Inboxes](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/inboxes.md)
- [Message Boards](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/message_boards.md)
- [Message types](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/message_types.md)
- [Messages](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/messages.md)
- [People](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/people.md)
- [Projects](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/projects.md)
- [Question answers](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/question_answers.md)
- [Questionnaires](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/questionnaires.md)
- [Questions](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/questions.md)
- [Recordings](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/recordings.md)
- [Schedule entries](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/schedule_entries.md)
- [Schedules](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/schedules.md)
- [Subscriptions](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/subscriptions.md)
- [Templates](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/templates.md)
- [To-do list groups](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/todolist_groups.md)
- [To-do lists](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/todolists.md)
- [To-dos](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/todos.md)
- [To-do sets](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/todosets.md)
- [Uploads](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/uploads.md)
- [Vaults](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/vaults.md)
- [Webhooks](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/webhooks.md)

## License

[MIT](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/LICENSE)

Copyright (c) 2017-present, Coopérative Belvédère Communication

