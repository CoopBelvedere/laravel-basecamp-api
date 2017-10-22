# Chatbots

## List chatbots

> Chatbots are only accessible via a Campfire resource.

```
$chatbots = $campfire->chatbots()->index();
```

## Get a chatbot

```
$chatbot = $campfire->chatbots()->show($id);
```

## Create a chatbot

```
$chatbot = $campfire->chatbots()->store([
    'service_name' => 'tally',
    'commmand_url' => 'https://example.com/endpoint',
]);
```

## Update a chatbot

```
$chatbot->update([
    'service_name' => 'uptime',
    'command_url' => 'https://example.com/endpoint',
]);

// Or
$campfire->chatbots()->update($id, [...]);
```

## Delete a chatbot

```
$chatbot->destroy();

// Or
$campfire->chatbots()->destroy($id);
```

## Create a line

```
$line = $chatbot->storeLine('Hello!');
```
