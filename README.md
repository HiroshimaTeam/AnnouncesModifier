# AnnouncesModifier
⚔️ Modify the damage to your favorite items as you see fit

# Features
- Change the default command messages (SAY and ME) which are both unchangeable from pocketmine.yml
- Assign tags to the say command which will allow you to change the prefix of the message!
# Configuration
```YAML
# Please do not move these numbers
version: "1.0"

commands:
  me:
    description: "Send a message with your name"
    permission: "pocketmine.command.me"

    # set permission: none for EVERYONE can use command
    message: "[ME] {SENDER}: {MESSAGE}"
  say:
    description: "Send a message"
    permission: "pocketmine.command.say"

    message: "[{PREFIX}] {MESSAGE}"
    types:
      server: # This is the default tag, update the "show" if you want
        show: "SERVER"
      # The type argument modifies the word SERVER in front of the SAY message, if you want to create several prefixes define here
      # Default: server (no type, just message /say blablablabla)
      # Exemple: /say test MY CAT IS BEAUTIFUL
      # Chat: [TESTT] MY CAT IS BEAUTIFUL
      test:
        show: "TESTT"
```