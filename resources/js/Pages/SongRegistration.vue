<script setup>
defineProps({
    videoId: {
        type: String,
    },
});

</script>

<!-- <template>
    <div
        class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="w-full max-w-2xl lg:max-w-7xl px-6">
            <div>
                <p><iframe width="560" height="315" :src="`https://www.youtube.com/embed/${videoId}`" 
            title="" frameBorder="0"   allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"  allowFullScreen></iframe></p>
                <label>Elektroninis pastas</label>
                <input name="email">
                <button @click.prevent="registerSong()">Registruoti dainą!</button>
            </div>
        </div>
    </div>
</template> -->

<!-- <template> 
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"> 
        <div class="w-full max-w-2xl lg:max-w-7xl px-6"> <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg"> <div class="mb-4"> <iframe width="560" height="315" :src="`https://www.youtube.com/embed/${videoId}`" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full rounded-lg" ></iframe> </div> <div class="mb-4"> <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Elektroninis paštas</label> <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-[#FF2D20] focus:border-[#FF2D20] sm:text-sm" placeholder="Įveskite savo el. paštą" /> </div> <button @click.prevent="registerSong()" class="w-full bg-[#FF2D20] text-white py-2 px-4 rounded-md shadow-md hover:bg-[#e0241b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF2D20]" > Registruoti dainą! </button> </div> </div> </div> </template> -->


<template> <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen flex items-center justify-center selection:bg-[#FF2D20] selection:text-white"> <div class="w-full max-w-2xl lg:max-w-7xl px-6"> <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mx-auto" style="max-width: 630px;"> <div class="mb-4"> <iframe width="100%" height="315" :src="`https://www.youtube.com/embed/${videoId}`" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full rounded-lg" ></iframe> </div> <div class="mb-4"> <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Elektroninis paštas</label> <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-[#FF2D20] focus:border-[#FF2D20] sm:text-sm" placeholder="Įveskite savo el. paštą" /> </div> <button @click.prevent="registerSong()" class="w-full bg-[#FF2D20] text-white py-2 px-4 rounded-md shadow-md hover:bg-[#e0241b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF2D20]" > Registruoti dainą! </button> </div> </div> </div> </template>