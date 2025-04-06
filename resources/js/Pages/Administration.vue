<template>
    <div id="admin-page">
      <h1>Administravimas</h1>
      <div class="button-container">
        <button @click="clearRegistrations()">Išvalyti registracijas</button>
      </div>
    </div>
  </template>
  
<script setup>
import axios from 'axios';


async function clearRegistrations() {
    const response = await axios.post('/registrations/admin/clear');
    if (response.status === 200) {
        alert('Registracijos išvalytos.');
    }
}
</script>
  
  <style scoped>
  #admin-page {
    text-align: center;
  }
  
  .button-container {
    margin-top: 20px;
  }
  
  button { margin: 0 10px; padding: 10px 20px; font-size: 16px; cursor: pointer; background-color: #007bff; /* Casual blue color */ color: #ffffff; border: none; border-radius: 5px; transition: background-color 0.3s; } button:hover { background-color: #0056b3; /* Darker blue on hover */ }
  </style>
  