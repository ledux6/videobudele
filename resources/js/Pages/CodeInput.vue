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
        if (error.response && error.response.status === 400) { 
            codeNotFound.value = true; 
        }
    }
}

</script>

<template>
    <div
        class="bg-white text-black dark:bg-gray-900 dark:text-white min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="w-full max-w-xl lg:max-w-4xl px-6">
            <div class="flex justify-center mb-5">
                <form @submit.prevent="inputCode" class="w-full max-w-sm" v-if="!waiting">
                    <div class="flex items-center border-b border-indigo-500 py-2">
                        <input
                            class="appearance-none bg-transparent border-none w-full text-gray-700 dark:text-gray-300 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            type="text" v-model="code" placeholder="Iveskite koda" maxlength="5" />
                        <label v-if="codeNotFound">Kodas nerastas</label>
                        <button
                            class="flex-shrink-0 bg-indigo-500 hover:bg-indigo-700 border-indigo-500 hover:border-indigo-700 text-sm border-4 py-1 px-2 rounded-full ml-2 transition duration-200"
                            type="submit">
                            Įvesti
                        </button>
                    </div>
                </form>
                <div v-if="waiting">
                    Laukiama
                </div>
            </div>
        </div>
    </div>
</template>
