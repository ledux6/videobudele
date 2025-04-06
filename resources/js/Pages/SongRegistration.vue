<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';


defineProps({
    videoId: {
        type: String,
    },
});

const apiKey = 'AIzaSyC77br-9-k1HBkznO36wQTVBOFAaTRi3vI'; // Replace with your API key

function getData() {
    const url = `https://www.googleapis.com/youtube/v3/videos?part=snippet&id=${videoId}&key=${apiKey}`;
    axios.post(url)
        .then(response => response.json())
        .then(data => {
            console.log('Video Data:', data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

const email = ref();

</script>

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
                    <input type="email" name="email" id="email" v-model="email"
                        class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-[#FF2D20] focus:border-[#FF2D20] sm:text-sm"
                        placeholder="Įveskite savo el. paštą" /> </div> 
                        <Link 
                            :href="route('song.reg.post')" 
                            method="post" 
                            :data="{ email: email, videoId: videoId }" 
                            class="w-full bg-[#FF2D20] text-white py-2 px-4 rounded-md shadow-md hover:bg-[#e0241b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF2D20]"
                            as="button"
                        >
                            Registruoti dainą! 
                        </Link>
            </div>
        </div>
    </div>
</template>