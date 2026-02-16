# BetterJoin
> A clean, modern Join/Leave message plugin for PocketMine-MP API 5  
> With full RankSystem integration 🚀

---

## 📦 Features

- ✅ Static join/leave messages
- 🔥 Dynamic rank-based colors
- 🎨 Clean bracket styling `[ + ]`
- 🔌 IvanCraft623 RankSystem support
- 🔊 Configurable join sound
- ⚡ Lightweight & optimized
- 🧩 Soft dependency support

---

## 🎮 How It Works

BetterJoin supports **two modes**:

---

### 🟢 Static Mode

Simple and clean.

- Join = Green
- Leave = Red
- No rank plugin required

**Example:**
<img width="336" height="105" alt="image" src="https://github.com/user-attachments/assets/d8d815d5-4e1a-4784-8c58-6a8a5c4704d0" />


### 🔥 Dynamic Mode (Rank-Based)

Automatically pulls player name color from:
IvanCraft623 RankSystem

BetterJoin reads the player's highest rank and applies:

- Rank nameColor → Player name
- Rank nameColor → + / - symbol
- Brackets always stay gray (§7)

**Example:**
<img width="331" height="115" alt="image" src="https://github.com/user-attachments/assets/8789b7c9-2900-40ad-abeb-71058a765dd7" />


## 🔌 RankSystem Integration

This plugin supports:
**IvanCraft623 RankSystem (PM5)**

It directly reads:
`$session->getHighestRank()->getNameTagFormat()["nameColor"];`

If RankSystem is not installed:
Plugin still loads
Falls back to default color

softdepend:
  - RankSystem

## 🔊 Join Sound

Enable or disable in config:
`sound:
  enabled: true`

## 📥 Installation

- Download the plugin `.phar`
- Place inside `/plugins`
- Restart server
- Configure if needed
