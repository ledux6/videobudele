<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

const registrations = ref([]);
async function fetchWaitingRegistrations() {
    const response = await axios.get('/registrations/waiting/items');
    if (response.status === 200) {
        registrations.value = response.data;
    }
}

async function close(id) {
    const response = await axios.post('/registration/item/close/' + id);
    fetchWaitingRegistrations();
}

onMounted(() => {
    setInterval(fetchWaitingRegistrations, 20000);
});

</script>
<template>
    <div
        class="bg-white text-black dark:bg-gray-900 dark:text-white min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="w-full max-w-6xl px-4">
            <div>
                <button @click.prevent="fetchRegistrations">Atnaujinti</button>
            </div>
            <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-800">
                        <th class="border border-gray-300 dark:border-gray-700 p-2">YouTube</th>
                        <th class="border border-gray-300 dark:border-gray-700 p-2">Kodas</th>
                        <th class="border border-gray-300 dark:border-gray-700 p-2">Email</th>
                        <th class="border border-gray-300 dark:border-gray-700 p-2">Laukia</th>
                        <th class="border border-gray-300 dark:border-gray-700 p-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in registrations" :key="item.id">
                        <td class="border border-gray-300 dark:border-gray-700 p-2">
                            <a :href="`https://www.youtube.com/watch?v=${item.youtube_video_id}`" target="_blank" class="youtube-link">{{
                                item.youtube_video_id }}</a>
                        </td>
                        <td class="border border-gray-300 dark:border-gray-700 p-2">{{ item.pseudo_random_id }}
                        </td>
                        <td class="border border-gray-300 dark:border-gray-700 p-2">{{ item.email }}</td>
                        <td class="border border-gray-300 dark:border-gray-700 p-2">
                            <span v-if="item.waiting" class="green-check">&#10003;</span>
                        </td>
                        <td>
                            <!-- <button v-if="item.waiting" class="cool-button" @click.prevent="close(item.id)">
                                Uždaryti
                            </button> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style>
 .cool-button {
     background-color: #FF0000;
     color: white;
     border: none;
     padding: 10px 20px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     /* Inline display */
     font-size: 16px;
     /* Font size */
     margin: 4px 2px;
     /* Margin */
     cursor: pointer;
     /* Pointer cursor on hover */
     border-radius: 12px;
     /* Rounded corners */
     transition: background-color 0.3s ease, transform 0.3s ease;
     /* Smooth transition */
 }

 .cool-button:hover {
     background-color: #CC0000;
     /* Darker red on hover */
     transform: scale(1.05);
     /* Slightly enlarge on hover */
 }

 .youtube-link {
     color: #1e40af;
     /* Blue color for links */
     text-decoration: underline;
     /* Underline to indicate it's a link */
     transition: color 0.3s ease;
 }

 .youtube-link:hover {
     color: #3b82f6;
     /* Lighter blue on hover */
     text-decoration: underline;
 }

 .youtube-link:visited {
     color: #7c3aed;
     /* Purple color for visited links */
 }
</style>
