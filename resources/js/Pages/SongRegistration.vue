<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    videoId: {
        type: String,
    },
});

const apiKey = import.meta.env.VITE_YOUTUBE_API_KEY; 
const title = ref([]);

async function getData() {
    if (!props.videoId) {
        return;
    }
    try {
        const response = await axios.get('https://www.googleapis.com/youtube/v3/videos', {       
            params: {
                id: props.videoId,
                key: import.meta.env.VITE_YOUTUBE_API_KEY,
                part: 'snippet'
            }
        });

        title.value = response.data.items[0].snippet.title;
    } catch(e) {
        console.log(e)
    }
}

const email = ref();
onMounted(() => {
    getData();
});

</script>

<template>
    <header class="header">
        <div class="logo">
            <img class="responsive-img" src="/discobox.png">
        </div>
    </header>
    <div class="container-initial height">
        <div class="flex ml-9" style="align-self: flex-start;">
            <Link :href="route('welcome')" >
                <button class="back-button">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.22502 10.5125L11.1625 15.45L9.00002 17.6L0.400024 9.00002L9.00002 0.400024L11.1625 2.55002L6.22502 7.48752H17.6V10.5125H6.22502Z" fill="white"/>
                    </svg>
                </button>
            </Link>
        </div>
        <div class="flex justify-center mt-5"> 
            <iframe width="320" height="180" :src="`https://www.youtube.com/embed/${videoId}`"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen 
                class="glow">
            </iframe> 
        </div>
        <h1 class="mx-9 mt-2">{{ title }}</h1>
        <div style="display: contents;">
            <hr>
        </div>
        
        <div class="flex justify-center mb-4 mx-11" style="max-width: 50vh;">
            <p>Dabar įrašykite savo el.paštą, juo gausite kodą dainos aktyvavimui disko būdelėje. Vėliau ten pat atkeliaus trumpas video iš Jūsų pasirodymo disko būdelėje.</p>
        </div>
        <div class="mb-4"> 
            <label for="email" class="ml-10 flex">Elektroninis paštas</label>
            <input type="email" name="email" id="email" v-model="email"
                class="song-input mb-5"
                placeholder="Įveskite savo el. paštą" /> 
                <Link 
                    :href="route('song.reg.post')" 
                    method="post" 
                    :data="{ email: email, videoId: videoId }" 
                    class="find-song-btn glow-button font-sans font-black"
                    as="button"
                >
                    Registruoti dainą! 
                </Link>
        </div> 
        
    </div>
</template>
<style>
@import '../../css/base.css';

.glow {
    border: 3px solid rgb(224, 224, 224); 
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.8); 
    border-radius: 5px; 
}

hr {
    width: 75%;
    height: 2px;
    border: none;
    border-top: 2px solid #ccc;
    margin: 15px 0;
    display:block;
}


.back-button {
    background: rgba(160, 160, 160, 0.36);
    border: none;
    color: white;
    padding: 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    border-radius: 50%;
} 
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
    max-width: 500px;
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