<template>
    <div class="p-10">
        <h1 class="text-x1 font-bold mb-2">Weather Forecast App</h1>

        <label for="city" class="block mb-2">Select a City:</label>
        <select id="city" v-model="selectedCity" class="border">
            <option disabled value="">- - - - - - - - - -</option>
            <option>Brisbane</option>
            <option>Gold Coast</option>
            <option>Sunshine Coast</option>
        </select>

        <div v-if="loading" class="text-center">Loading forecast...</div>

        <div v-if="error" class="text-red-600 font-semibold">{{ error }}</div>

        <div v-if="forecast">
        <h2 class="font-semibold mb-2">Forecast for {{ selectedCity }}</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-2 py-1">Day</th>
                    <th class="border border-gray-300 px-2 py-1">Avg Temp (°C)</th>
                    <th class="border border-gray-300 px-2 py-1">Max Temp (°C)</th>
                    <th class="border border-gray-300 px-2 py-1">Min Temp (°C)</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(day, index) in forecast" :key="day.date">
                    <td class="border border-gray-300 px-2 py-1">Day {{ index + 1 }} ({{ day.date }})</td>
                    <td class="border border-gray-300 px-2 py-1">{{ day.temp_avg }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ day.temp_max }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ day.temp_min }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const cities = ['Brisbane','Gold Coast','Sunshine Coast']
const selectedCity = ref("")

const forecast = ref(null)
const loading = ref(false)
const error = ref('')

watch(selectedCity, (newCity) => {
    if (!newCity) {
        forecast.value = null
        error.value = ''
        return
    }

    loading.value = true
    forecast.value = null
    error.value = ''
    
    fetch(`http://localhost:8000/api/forecast/${encodeURIComponent(newCity)}`).then(res => {
        if (!res.ok) throw new Error('Failed to fetch forecast')
        return res.json()
    })
    .then(data => {
        if (data.error) {
            error.value = data.error
        } else {
            forecast.value = data
        }
    })
    .catch(() => {
        error.value = 'Error fetching forecast'
    })
    .finally(() => {
        loading.value = false
    })

})

</script>