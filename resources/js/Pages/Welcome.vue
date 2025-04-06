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
    <header class="header">
        <div class="logo">
            <img class="responsive-img" src="/discobox.png">
        </div>
    </header>
    <div :class="youtubeResults.length === 0 ? 'container-initial height' : 'container-initial'">
        <div class="content" v-if="youtubeResults.length === 0">
            <h1 class="p-3">Pasirinkite savo mėgstamą dainą!</h1>
            <label class="ml-10 flex">Dainos arba atlikėjo pavadinimas</label>
            <form @submit.prevent="searchYouTube">
                <input type="text" class="song-input mb-5" v-model="search">
                <button class="find-song-btn" type="submit">
                    <svg class="w-4 h-4 mr-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg> 
                    Ieškoti
                </button>
            </form>
            <div class="flex justify-center mt-5">
                <div class="items-center" style="flex-direction: column;">
                    <div>
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight">
                            Top
                        </h5>
                    </div>
                    <ol class="list-decimal">
                        <li v-for="(item, index) in top5" :key="item.id" class="mb-2">
                            <a :href="`song-registration/${item.video_id}`">{{ item.title.substring(0, 40) }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div v-else>
            <h2 class="mt-5 p-1">Pasirinkite savo mėgstamą dainą!</h2>
            <form @submit.prevent="searchYouTube" class="justify-center flex mb-5">
                <input type="text" class="song-input" v-model="search">
                <button class="find-song-btn-sm ml-1 p-2" type="submit">
                    <svg width="15px" height="15px" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg> 
                </button>
            </form>
        </div>
        <div class="flex flex-wrap justify-center">
            <div v-for="result in youtubeResults" :key="result.id.videoId" class="p-2">
                <Link 
                    :href="route('songRegistration', result.id.videoId)"
                >
                    <div 
                        class="card max-w-sm rounded-lg shadow-sm p-5"
                    >
                        <div class="img-container">
                            <img class="rounded-t-md img" :src="result.snippet.thumbnails?.high?.url" alt="" />
                        </div>
                        <div>
                            <h6 class="mt-2 text-2xl tracking-tight">{{ result.snippet.title }}</h6>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>
<style>
.container-initial {
    margin: 0;
    font-family: Arial, sans-serif;
    background-image: url(/background.svg);
    background-repeat: repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
    flex-wrap: wrap;
}

.height {
    height: 100vh;
}

.card {
    background: rgba(160, 160, 160, 0.36);
}

.highlight {
    color: #FF1493;
}

.content h1 {
    font-size: 2em;
    margin-bottom: 20px;
    font-family: fantasy;
}

.song-input {
    background: rgba(205, 205, 205, 0.36);
    width: 80%;
    padding: 10px;
    font-size: 1em;
    border: none;
    border-radius: 5px;
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
    width: 80%;
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

.responsive-img {
    width: 15%;
}

.header {
    background-image: url(/background.svg);
}

.logo {
    display: flex;
    align-items: center;
    justify-content: center;
}

.img-container {
    width: 320px;
    height: 180px;
}
.img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>