<script setup>
import axios from 'axios';
import { ref } from 'vue';

const code = ref('');
const waiting = ref(false);
const codeNotFound = ref(false);

async function inputCode() {
    codeNotFound.value = false;
    waiting.value = true;
    try {
        const response = await axios.post('/code', { 'code': code.value }); 
    } catch (error) { 
        if (error.response.status === 400) { 
            codeNotFound.value = true; 
            waiting.value = false;
        }
    }
}

</script>

<template>
    <header class="header">
        <div class="logo">
            <img class="responsive-img" src="/discobox.png">
        </div>
    </header>
    <div class="container-initial height">
        <h1 style="font-size: 4em;" class="mt-20">Įveskite kodą</h1>
        <div class="flex justify-center mb-5 mt-10">
            <form @submit.prevent="inputCode" class="w-full max-w-sm" v-if="!waiting">
                <div class="flex flex-col items-center">
                    <input
                        class="song-input mb-4"
                        type="text" 
                        v-model="code" 
                        maxlength="10" 
                        style="width: 300px; text-align: center; font-size: 1.5em"
                    />
                    <label v-if="codeNotFound" class="mb-4" style="color: #ff6b6b; font-size: 1.2em; font-weight: bold;">Kodas nerastas</label>
                    <button
                        class="find-song-btn glow-button font-sans font-black"
                        type="submit"
                    >
                        Įvesti
                    </button>
                </div>
            </form>
            <div v-if="waiting" class="mt-10">
                <div style="font-size: 2em; font-family: fantasy;">Laukiama...</div>
            </div>
        </div>
    </div>
</template>

<style>
@import '../../css/base.css';

.container-initial {
    margin: 0;
    font-family: Arial, sans-serif;
    background-image: url(/background.svg);
    background-repeat: repeat;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    color: white;
    text-align: center;
    flex-wrap: nowrap;
    flex-direction: column;
}

h1 {
    font-size: 2em;
    margin-bottom: 20px;
    font-family: fantasy;
}

.song-input {
    background: rgba(205, 205, 205, 0.36);
    padding: 10px;
    font-size: 1em;
    border: none;
    border-radius: 5px;
    color: white;
}

.song-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.song-input:focus {
    outline: none;
    background: rgba(205, 205, 205, 0.5);
}

.find-song-btn {
    background-color: #FF1493;
    color: white;
    border: none;
    padding: 20px 20px;
    font-size: 1em;
    border-radius: 5px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 250px;
    max-width: 500px;
}

.find-song-btn-sm {
    background-color: #FF1493;
    color: white;
    border: none;
    border-radius: 5px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.find-song-btn .icon {
    margin-right: 10px;
}
</style>
