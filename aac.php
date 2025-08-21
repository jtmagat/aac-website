<?php
// aac.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AAC Communication</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Tabs */
    .tab-btn { 
      padding: 0.75rem 1.5rem; 
      cursor: pointer; 
      color: #555; 
      font-weight: 600;
      transition: all 0.2s;
    }
    .tab-btn.active {
      color: #000;
      border-bottom: 3px solid #000;
    }

    /* Word buttons */
    .word-btn-container {
      position: relative;
    }

    .word-btn {
      padding: 1.5rem 1rem;
      background: #f9f9f9;
      border: 2px solid #ddd;
      border-radius: 1rem;
      text-align: center;
      font-size: 1.25rem;
      font-weight: 600;
      color: #000;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }
    .word-btn:hover {
      background: #e5e5e5;
      transform: scale(1.05);
    }

    .star {
      width: 24px;
      height: 24px;
      cursor: pointer;
      transition: transform 0.3s;
    }

    .star.animate {
      transform: scale(1.3);
    }

    /* Header / Navbar */
    header {
      background: #fff;
      border-bottom: 1px solid #ddd;
    }

    /* Buttons */
    button {
      transition: all 0.2s;
    }
    button:hover {
      opacity: 0.85;
    }

    /* Speech textarea */
    #speechText {
      width: 100%;
      min-height: 120px;
      max-height: 300px;
      padding: 1rem;
      font-size: 1.25rem;
      border: 2px solid #333;
      border-radius: 1rem;
      background: #f5f5f5;
      color: #000000;
      resize: vertical;
      box-sizing: border-box;
    }

    /* Dropdown */
    #customDropdown {
      background: #fff;
      color: #000;
      border: 2px solid #ddd;
      border-radius: 1rem;
    }
    #customDropdown input, #customDropdown select {
      background: #f3f3f3;
      color: #000;
      border: 1px solid #ccc;
      padding: 0.5rem;
      border-radius: 0.5rem;
    }

    /* Footer */
    footer {
      background: #fff;
      color: #555;
      border-top: 1px solid #ddd;
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    ::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 4px;
    }
    ::-webkit-scrollbar-track {
      background: #f9f9f9;
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">

  <!-- Header / Navbar -->
  <header class="shadow">
    <div class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
      <h1 class="text-2xl font-bold flex items-center gap-2">🗣️ AAC Communication</h1>
      <div class="flex items-center gap-4">
        <button onclick="toggleCustomDropdown()" class="bg-black text-white px-5 py-2 rounded-xl hover:bg-gray-800">➕ Custom Word</button>
        <a href="index.php" class="bg-gray-200 text-black px-4 py-2 rounded-xl hover:bg-gray-300">🏠 Home</a>
      </div>
    </div>
  </header>

  <!-- Custom Word Dropdown -->
  <div id="customDropdown" class="hidden absolute top-28 left-1/2 -translate-x-1/2 shadow-lg p-6 w-96 z-50">
    <h2 class="text-xl font-bold mb-4">Add Custom Word</h2>
    <input id="customWordInput" type="text" class="w-full mb-4" placeholder="Enter word/phrase">
    <select id="customCategory" class="w-full mb-4">
      <option value="custom">➕ Custom</option>
      <option value="needs">🛠️ Needs</option>
      <option value="food">🍎 Food</option>
      <option value="emotions">😊 Emotions</option>
      <option value="wants">✨ Wants</option>
      <option value="favorites">⭐ Favorites</option>
    </select>
    <div class="flex gap-4">
      <button onclick="saveCustomWord()" class="flex-1 bg-black text-white px-4 py-2 rounded-xl hover:bg-gray-800">Save</button>
      <button onclick="toggleCustomDropdown()" class="flex-1 bg-gray-200 px-4 py-2 rounded-xl hover:bg-gray-300">Cancel</button>
    </div>
  </div>

  <!-- Main -->
  <main class="max-w-6xl mx-auto px-6 py-12 space-y-12">

    <!-- Speech Output -->
    <div class="bg-white shadow p-6 rounded-2xl">
      <textarea id="speechText" rows="3" placeholder="Select words or type your message..."></textarea>
      <div class="flex gap-4 mt-4">
        <button onclick="speakText()" class="flex-1 bg-black text-white px-4 py-3 rounded-xl hover:bg-gray-800 text-lg">🔊 Speak</button>
        <button onclick="clearText()" class="flex-1 bg-gray-200 px-4 py-3 rounded-xl hover:bg-gray-300 text-lg">❌ Clear</button>
      </div>
    </div>

    <!-- Tabs -->
    <div>
      <div class="flex gap-4 border-b pb-2 overflow-x-auto text-lg font-semibold">
        <button onclick="showTab('all', event)" class="tab-btn active">All</button>
        <button onclick="showTab('needs', event)" class="tab-btn">Needs</button>
        <button onclick="showTab('food', event)" class="tab-btn">Food</button>
        <button onclick="showTab('emotions', event)" class="tab-btn">Emotions</button>
        <button onclick="showTab('wants', event)" class="tab-btn">Wants</button>
        <button onclick="showTab('favorites', event)" class="tab-btn">Favorites</button>
        <button onclick="showTab('recent', event)" class="tab-btn">Recent</button>
        <button onclick="showTab('custom', event)" class="tab-btn">Custom</button>
      </div>

<!-- ALL -->
<div id="all" class="tab-content mt-8">
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Hello')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Hello')">Hello</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Hi')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Hi')">Hi</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Yes')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Yes')">Yes</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'No')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('No')">No</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Please')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Please')">Please</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Thank you')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Thank you')">Thank you</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Sorry')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Sorry')">Sorry</div></div>
  </div>
</div>

<!-- NEEDS -->
<div id="needs" class="tab-content hidden mt-8">
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Water')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Water')">Water</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Food')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Food')">Food</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Sleep')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Sleep')">Sleep</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Bathroom')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Bathroom')">Bathroom</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Clothes')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Clothes')">Clothes</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Medicine')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Medicine')">Medicine</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Help')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Help')">Help</div></div>
  </div>
</div>

<!-- FOOD -->
<div id="food" class="tab-content hidden mt-8">
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Apple')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Apple')">Apple</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Bread')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Bread')">Bread</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Milk')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Milk')">Milk</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Eggs')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Eggs')">Eggs</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Rice')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Rice')">Rice</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Cheese')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Cheese')">Cheese</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Juice')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Juice')">Juice</div></div>
  </div>
</div>

<!-- EMOTIONS -->
<div id="emotions" class="tab-content hidden mt-8">
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Happy')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Happy')">Happy</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Sad')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Sad')">Sad</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Angry')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Angry')">Angry</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Scared')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Scared')">Scared</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Tired')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Tired')">Tired</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Excited')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Excited')">Excited</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Bored')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Bored')">Bored</div></div>
  </div>
</div>

<!-- WANTS -->
<div id="wants" class="tab-content hidden mt-8">
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Toy')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Toy')">Toy</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Book')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Book')">Book</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Bike')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Bike')">Bike</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Candy')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Candy')">Candy</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Game')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Game')">Game</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Chocolate')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Chocolate')">Chocolate</div></div>
    <div class="word-btn-container"><div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'Pet')"><svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></div><div class="word-btn" onclick="addWord('Pet')">Pet</div></div>
  </div>
</div>

      <!-- FAVORITES -->
      <div id="favorites" class="tab-content hidden mt-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
        <!-- Dynamically populated -->
      </div>

    <!-- RECENT -->
<div id="recent" class="tab-content hidden mt-8">
  <div class="flex justify-end mb-2">
    <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600" onclick="clearRecent()">Clear</button>
  </div>
  <div id="recent-words" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
    <!-- Last 10 clicked words will appear here -->
  </div>
</div>

      <!-- CUSTOM -->
      <div id="custom" class="tab-content hidden mt-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
        <!-- Dynamically added -->
      </div>

    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center py-6 mt-12">
    AAC Communication - Simple AAC App
  </footer>

<script>
  // Tabs
  function showTab(tabId, event) {
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
    document.getElementById(tabId).classList.remove('hidden');

    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    event.currentTarget.classList.add('active');
  }

  // Recent Words
  let recentWords = [];

  function addWord(word) {
    addToRecent(word); // Add to recent

    const textarea = document.getElementById('speechText');
    textarea.value += (textarea.value ? ' ' : '') + word;
  }

  function addToRecent(word) {
    recentWords = recentWords.filter(w => w !== word); // Remove if exists
    recentWords.unshift(word); // Add to front
    if (recentWords.length > 10) recentWords.pop(); // Keep last 10
    renderRecent();
  }

  function renderRecent() {
    const container = document.getElementById("recent");
    container.innerHTML = "";

    recentWords.forEach(word => {
      const div = document.createElement("div");
      div.className = "word-btn-container";
      div.innerHTML = `<div class="word-btn" onclick="addWord('${word}')">${word}</div>`;
      container.appendChild(div);
    });

    if (recentWords.length > 0) {
      const clearBtn = document.createElement("button");
      clearBtn.textContent = "Clear Recent";
      clearBtn.className = "clear-btn mt-2 p-2 bg-red-500 text-white rounded";
      clearBtn.onclick = clearRecent;
      container.appendChild(clearBtn);
    }
  }

  function clearRecent() {
    recentWords = [];
    renderRecent();
  }

  // Favorites
  let favorites = [];

  function toggleFavorite(starEl, word) {
    event.stopPropagation();
    const index = favorites.indexOf(word);
    const star = starEl.querySelector('.star');

    if (index === -1) {
      favorites.push(word);
      star.classList.remove('text-gray-400');
      star.classList.add('text-yellow-400','animate');
      setTimeout(()=>star.classList.remove('animate'), 300);
    } else {
      favorites.splice(index,1);
      star.classList.remove('text-yellow-400');
      star.classList.add('text-gray-400');
    }
    updateFavoritesTab();
  }

  function updateFavoritesTab() {
    const favoritesTab = document.getElementById('favorites');
    favoritesTab.innerHTML = '';
    favorites.forEach(word => {
      const div = document.createElement('div');
      div.className = 'word-btn-container';
      div.innerHTML = `
        <div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'${word}')">
          <svg class="star text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
          </svg>
        </div>
        <div class="word-btn" onclick="addWord('${word}')">${word}</div>
      `;
      favoritesTab.appendChild(div);
    });
  }

  // Speech
  function speakText(){
    const text = document.getElementById('speechText').value;
    if(text.trim()){
      const utterance = new SpeechSynthesisUtterance(text);
      speechSynthesis.speak(utterance);
    }
  }

  function clearText(){
    document.getElementById('speechText').value = '';
  }

  // Custom Word Dropdown
  function toggleCustomDropdown(){
    document.getElementById('customDropdown').classList.toggle('hidden');
  }

  function saveCustomWord(){
    const word = document.getElementById('customWordInput').value.trim();
    const category = document.getElementById('customCategory').value;

    if(!word) return alert('Please enter a word.');

    const container = document.createElement('div');
    container.className = 'word-btn-container';
    container.innerHTML = `
      <div class="absolute -top-3 right-2" onclick="toggleFavorite(this,'${word}')">
        <svg class="star text-gray-400" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
        </svg>
      </div>
      <div class="word-btn" onclick="addWord('${word}')">${word}</div>
    `;

    const targetTab = document.getElementById(category);
    targetTab.appendChild(container);

    document.getElementById('customWordInput').value = '';
    toggleCustomDropdown();
  }
</script>
   
</body>
</html>
