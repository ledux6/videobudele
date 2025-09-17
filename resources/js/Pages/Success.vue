<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    code: {
        type: String,
    },
});
</script>

<template>
    <header class="header">
        <div class="logo">
            <img class="responsive-img" src="/discobox.png">
        </div>
    </header>
    <div class="container-initial height">
        <h1 style="font-size: 4em;" class="mt-20">Puiku!</h1>
        <code class="whitespace-pre-wrap" style="font-size: 3em;">{{ code }}</code>
        <div class="flex justify-center mt-5 mb-3 pt-10 mx-12" style="max-width: 50vh;">
            <div>Savo el.pašte rasite pasirinktos dainos kodą, jį reikės suvesti diskobūdelės viduje! Tegul vakarėlis prasideda!</div>
        </div>
        <div class="mb-4 mt-5"> 
            <Link 
                :href="route('welcome')" 
                class="find-song-btn glow-button font-sans font-black"
                as="button"
            >
                Rinktis dar vieną dainą
            </Link>
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