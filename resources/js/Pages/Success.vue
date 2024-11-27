<script setup>
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

let youtubeResults = ref([]);
const search = ref('Jusu norima daina!')

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

<!-- <template>
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header
                    class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3"
                >
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>
                <div class="items-center">
                    <form>
                        <input type="text" v-model="search">
                        <button @click.prevent="searchYouTube()">
                            Search
                        </button>
                    </form>
                </div>
                <div v-for="result in youtubeResults" :key="result.id.videoId">
                    <p>{{ result.snippet.title }}</p>
                    <img :src="result.snippet.thumbnails?.medium?.url">
                </div>
            </div>
        </div>
    </div>
</template> -->
<template>
    <div
        class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen flex items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="w-full max-w-2xl lg:max-w-7xl px-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mx-auto" style="max-width: 630px;">
                <div class="mb-4"> <iframe width="100%" height="315" :src="`https://www.youtube.com/embed/${videoId}`"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen class="w-full rounded-lg"></iframe> </div>
                <div class="mb-4"> <label for="email"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Elektroninis paštas</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-[#FF2D20] focus:border-[#FF2D20] sm:text-sm"
                        placeholder="Įveskite savo el. paštą" /> </div> <button @click.prevent="registerSong()"
                    class="w-full bg-[#FF2D20] text-white py-2 px-4 rounded-md shadow-md hover:bg-[#e0241b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF2D20]">
                    Registruoti dainą! </button>
            </div>
        </div>
    </div>
</template>