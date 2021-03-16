# Subscriptions

## Get the subscription info

Show the subscribers / subscription info for any "recordings" object: Messages, Comments, Documents,
Uploads, etc...

```php
$subscription = $recording->subscriptions()->show();
```

## Subscribe the current user

```php
$subscription = $recording->subscriptions()->subscribe();
```

## Unsubscribe the current user

```php
$response = $recording->subscriptions()->unsubscribe();
```

## Update the subscription info

Pass the array of people id to subscribe or unsubscribe.

```php
$subscription = $recording->subscriptions()->update([
    "subscriptions": [4,5,6],
    "unsubscriptions": [1,2,3],
]);
```
