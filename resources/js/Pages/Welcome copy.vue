<script setup>
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, onMounted } from 'vue';

let youtubeResults = ref([]);
const top5 = ref([]);
const search = ref('');

async function searchYouTube() {
    try {
        const { data, status } = await axios.get('https://www.googleapis.com/youtube/v3/search', {
            // transfer this key to .env later on 
            params: {
                key: 'AIzaSyC77br-9-k1HBkznO36wQTVBOFAaTRi3vI',
                q: search.value,
                part: 'snippet',
                maxResults: 30,
                type: 'video',
                videoEmbeddable: true
            }
        })

        youtubeResults.value = data.items;
    } catch (error) {
        if (axios.isAxiosError(error)) {
            console.log('error message: ', error.message);
            return error.message;
        } else {
            console.log('unexpected error: ', error);
            return 'An unexpected error occurred';
        }
    }
}

async function fetchTop5() {
    try {
        const { data, status } = await axios.get('/registrations/logs/top')

        top5.value = data;
    } catch (error) {
        if (axios.isAxiosError(error)) {
            console.log('error message: ', error.message);
            return error.message;
        } else {
            console.log('unexpected error: ', error);
            return 'An unexpected error occurred';
        }
    }
}

onMounted(() => {
    fetchTop5();
});
</script>

<template>
    <div class="body w-full px-6 bg-white dark:bg-gray-800 rounded-lg px-6 py-8 ring shadow-xl ring-gray-900/5">
    <div>
        <div>
            <div class="flex justify-center m-9">
                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Video Būdelė</h1>
            </div>
            <div class="flex justify-center mb-9">
                <form @submit.prevent="searchYouTube"  class="flex items-center max-w-sm mx-auto">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <input v-model="search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ieškoti dainos..." required />
                    </div>
                    <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </form>
            </div>
            <div class="flex justify-center">
                <div class="items-center" style="flex-direction: column;">
                    <div class="flex justify-center">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            Top
                        </h5>
                    </div>
                    <ol class="list-decimal dark:text-white">
                        <li v-for="(item, index) in top5" :key="item.id" class="mb-2">
                            <a :href="`song-registration/${item.video_id}`">{{ item.title.substring(0, 40) }}</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <Link 
                v-for="result in youtubeResults" :key="result.id.videoId"
                :href="route('songRegistration', result.id.videoId)">
                    <div 
                        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <img class="rounded-t-md" :src="result.snippet.thumbnails?.high?.url" alt="" />
                        <div class="p-5">
                            <h6 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ result.snippet.title }}</h6>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </div>
    </div>
</template>
<style>
</style>