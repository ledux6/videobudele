<script setup>
defineProps({
    code: {
        type: String,
    },
});
</script>

<template>
    <div class="min-h-screen flex items-center justify-center text-black dark:text-white">
        <div class="max-w-xl w-full px-4">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mx-auto border border-gray-300 dark:border-gray-700">
                <h2 class="text-3xl font-bold mb-4 text-center text-gray-800 dark:text-gray-200">Jūsų kodas:</h2>
                <pre class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 p-4 rounded-lg shadow-inner overflow-auto text-lg leading-relaxed">
                    <code class="whitespace-pre-wrap">{{ code }}</code>
                </pre>
            </div>
        </div>
    </div>
</template>
