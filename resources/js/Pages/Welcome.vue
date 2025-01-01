<script setup>
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

let youtubeResults = ref([]);
const search = ref('')

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

async function searchYouTube() {
    try {
        const { data, status } = await axios.get('https://www.googleapis.com/youtube/v3/search', {
            // transfer this key to .env later on 
            params: {
                key: 'AIzaSyC77br-9-k1HBkznO36wQTVBOFAaTRi3vI',
                q: search.value,
                part: 'snippet',
                maxResults: 6,
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
</script>

<template>
    <div
        class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="w-full max-w-2xl lg:max-w-7xl px-6">
            <header class="grid grid-cols-2 lg:grid-cols-3 gap-2 py-10 items-center">
                <nav v-if="canLogin" class="flex justify-end space-x-4">
                    <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                        class="rounded-md px-3 py-2 text-black dark:text-white ring-1 ring-transparent transition hover:text-black/70 dark:hover:text-white/80 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white">
                    Dashboard </Link> <template v-else>
                        <Link :href="route('login')"
                            class="rounded-md px-3 py-2 text-black dark:text-white ring-1 ring-transparent transition hover:text-black/70 dark:hover:text-white/80 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white">
                        Log in </Link>
                        <Link v-if="canRegister" :href="route('register')"
                            class="rounded-md px-3 py-2 text-black dark:text-white ring-1 ring-transparent transition hover:text-black/70 dark:hover:text-white/80 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white">
                        Register </Link>
                    </template>
                </nav>
            </header>
            <div class="flex justify-center mb-6">
                <form @submit.prevent="searchYouTube" class="w-full max-w-sm">
                    <div class="flex items-center border-b border-teal-500 py-2"> <input
                            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            type="text" v-model="search" placeholder="Ieškoti dainos." aria-label="Search YouTube" />
                        <button
                            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                            type="submit"> Ieškoti </button> </div>
                </form>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="result in youtubeResults" :key="result.id.videoId" class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                    <Link :href="route('songRegistration', result.id.videoId)">
                        <p class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-2">{{ result.snippet.title }}</p> 
                        <img :src="result.snippet.thumbnails?.medium?.url" class="w-full h-auto rounded-md">
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>