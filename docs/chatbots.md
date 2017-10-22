# Chatbots

## List chatbots

> Chatbots are only accessible via a Campfire resource.

```php
$chatbots = $campfire->chatbots()->index();
```

## Get a chatbot

```php
$chatbot = $campfire->chatbots()->show($id);
```

## Create a chatbot

```php
$chatbot = $campfire->chatbots()->store([
    'service_name' => 'tally',
    'commmand_url' => 'https://example.com/endpoint',
]);
```

## Update a chatbot

```php
$chatbot->update([
    'service_name' => 'uptime',
    'command_url' => 'https://example.com/endpoint',
]);

// Or
$campfire->chatbots()->update($id, [...]);
```

## Delete a chatbot

```php
$chatbot->destroy();

// Or
$campfire->chatbots()->destroy($id);
```

## Create a line

```php
$line = $chatbot->storeLine('Hello!');
```
