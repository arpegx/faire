<pre>
  __       _          
 / _| __ _(_)_ __ ___ 
| |_ / _` | | '__/ _ \
|  _| (_| | | | |  __/
|_|  \__,_|_|_|  \___|

</pre> Author: Lars Pleger, arpegx@posteo.de

# Prerequisites

```shell
podman run -d -v ollama:/root/.ollama -p 11434:11434 --name ollama ollama/ollama
# podman start/stop ollama
```

# Development environment

```shell
nix-shell -p piper-tts jq chromium php
```

# Bootstrap application

```shell
php -S localhost:8001 &
chromium &
```
