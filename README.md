# PermissionShop

**Version:** 1.0.0  
**API:** 5.0.0  
**Author:** jxrian4  

## Brief Description
PermissionShop allows players to purchase permissions with in-game currency. This plugin integrates with EconomyAPI for transactions and utilizes FormAPI to present a user-friendly interface.

## Key Features
- **User-Friendly Interface:** Purchase permissions through an easy-to-use GUI.
- **Integration with EconomyAPI:** Conduct transactions using in-game currency.
- **Flexible Configuration:** Prices and permissions can be customized through the configuration file.
- **Feedback Messages:** Provides players with success or failure messages upon attempting to purchase permissions.

## Usage
1. **Opening Permission Shop:** Players can open the shop menu by typing `/permshop` in-game.
2. **Selecting a Permission to Purchase:** Players choose the desired permission from the GUI that appears.
3. **Transaction:** If the player has enough money, they will purchase the permission, and the money will be deducted from their account.

## Permissions
- `permshop.cmd`: Allows players to use the `/permshop` command.

## Installation
1. Ensure your PocketMine-MP server is compatible with API 5.0.0.
2. Download `PermissionShop.phar` and place it in your server's `/plugins` folder.
3. Download and install dependencies, namely FormAPI and EconomyAPI, in the same manner.
4. Restart your server.
5. Configure `config.yml` in the plugin folder as needed.

## Configuration
- `form-title` and `form-content`: Set the title and content of the GUI.
- `close-button`: Set the text for the GUI's close button.
- Permissions and Buttons: Add or configure purchasable permissions and their prices.
- `msg-success` and `msg-not-enough`: Set the messages that appear when a transaction is successful or fails.
