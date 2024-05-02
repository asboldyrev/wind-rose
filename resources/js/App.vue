<template>
    <div class="layout p-3">
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span id="inputGroup-sizing-sm" class="input-group-text">Широта</span>
                    <input
                        v-model="latitude"
                        min="-90"
                        max="90"
                        step="0.000001"
                        type="number"
                        class="form-control"
                        aria-describedby="inputGroup-sizing-sm"
                    >
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <span id="inputGroup-sizing-sm" class="input-group-text">Долгота</span>
                    <input
                        v-model="longitude"
                        min="-180"
                        max="180"
                        step="0.000001"
                        type="number"
                        class="form-control"
                        aria-describedby="inputGroup-sizing-sm"
                    >
                </div>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary" @click="submit">Рассчитать</button>
            </div>
        </div>

        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link" :class="{'active': currentTab == 'main'}" aria-current="page" @click="currentTab = 'main'">За год</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{'active': currentTab == 'direction'}" aria-current="page" @click="currentTab = 'direction'">Направление</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{'active': currentTab == 'speed'}" aria-current="page" @click="currentTab = 'speed'">Скорость</a>
            </li>
        </ul>

        <div v-if="currentTab == 'main'" class="row my-3">
            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 mb-3">
                <div class="card card-default">
                    <div class="card-header">
                        Направление
                    </div>
                    <div class="card-body">
                        <Radar
                            :options="chartOptions"
                            :data="chartData(data.year.direction, 0)"
                        />
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 mb-3">
                <div class="card card-default">
                    <div class="card-header">
                        Скорость
                    </div>
                    <div class="card-body">
                        <Radar
                            :options="chartOptions"
                            :data="chartData(data.year.speed, 1)"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div v-if="currentTab == 'direction'" class="row my-3">
            <div v-for="(month, index) in data.direction" :key="index" class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-2 mb-3">
                <div class="card card-default">
                    <div class="card-header">
                        {{ months[index] }}
                    </div>
                    <div class="card-body">
                        <Radar
                            :options="chartOptions"
                            :data="chartData(month, index)"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div v-if="currentTab == 'speed'" class="row my-3">
            <div v-for="(month, index) in data.speed" :key="index" class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-2 mb-3">
                <div class="card card-default">
                    <div class="card-header">
                        {{ months[index] }}
                    </div>
                    <div class="card-body">
                        <Radar
                            :options="chartOptions"
                            :data="chartData(month, index)"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Radar } from 'vue-chartjs'
import { Chart as ChartJS, Title, ArcElement, Tooltip, Legend, LineElement, PointElement, CategoryScale, RadialLinearScale, Filler } from 'chart.js'
import { ref } from 'vue'
import { windRoseData } from '@site/api/wind-rose'

const currentTab = ref('main')

ChartJS.register(Title, Tooltip, Legend, CategoryScale, PointElement, RadialLinearScale, LineElement, ArcElement, Filler)

const latitude = ref(-34.3591)
const longitude = ref(18.4725)

const data = ref({
    direction: [],
    speed: [],
    year: {
        direction: [],
        speed: [],
    },
})
const colors = [
    {
        backgroundColor: 'rgba(234, 85, 69, 0.2)',
        borderColor: '#ea5545',
        pointBackgroundColor: '#ea5545',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#ea5545',
    },
    {
        backgroundColor: 'rgba(244, 106, 155, 0.2)',
        borderColor: '#f46a9b',
        pointBackgroundColor: '#f46a9b',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#f46a9b',
    },
    {
        backgroundColor: 'rgba(239, 155, 32, 0.2)',
        borderColor: '#ef9b20',
        pointBackgroundColor: '#ef9b20',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#ef9b20',
    },
    {
        backgroundColor: 'rgba(237, 191, 51, 0.2)',
        borderColor: '#edbf33',
        pointBackgroundColor: '#edbf33',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#edbf33',
    },
    {
        backgroundColor: 'rgba(237, 225, 91, 0.2)',
        borderColor: '#ede15b',
        pointBackgroundColor: '#ede15b',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#ede15b',
    },
    {
        backgroundColor: 'rgba(189, 207, 50, 0.2)',
        borderColor: '#bdcf32',
        pointBackgroundColor: '#bdcf32',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#bdcf32',
    },
    {
        backgroundColor: 'rgba(135, 188, 69, 0.2)',
        borderColor: '#87bc45',
        pointBackgroundColor: '#87bc45',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#87bc45',
    },
    {
        backgroundColor: 'rgba(39, 174, 239, 0.2)',
        borderColor: '#27aeef',
        pointBackgroundColor: '#27aeef',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#27aeef',
    },
    {
        backgroundColor: 'rgba(179, 61, 198, 0.2)',
        borderColor: '#b33dc6',
        pointBackgroundColor: '#b33dc6',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#b33dc6',
    },
]

const months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь']

function chartData(data, index) {
    const datasets = []

    const colorIndex = (colors.length)

    datasets.push(Object.assign(
        {
            label: months[index],
            data: data || [],
            fill: true,
        },
        colors[index % colorIndex],
    ))

    return {
        labels: [
            'N', 'NNE', 'NE', 'ENE',
            'E', 'ESE', 'SE', 'SSE',
            'S', 'SSW', 'SW', 'WSW',
            'W', 'WNW', 'NW', 'NNW',
        ],
        datasets,
    }
}

const chartOptions = ref({
    elements: {
        line: {
            borderWidth: 3,
        },
    },
    plugins: {
        legend: {
            display: false,
        },
    },
})

function submit() {
    windRoseData({
        latitude: latitude.value,
        longitude: longitude.value,
    }).then(response => {
        data.value.direction = []
        data.value.speed = []
        response.data?.direction?.forEach(month => {
            data.value.direction.push(month)
        })
        response.data?.speed?.forEach(month => {
            data.value.speed.push(month)
        })

        data.value.year.direction = response.data?.year?.direction
        data.value.year.speed = response.data?.year?.speed
    })
}

submit()

</script>

<style lang="scss" scoped>
 .nav-item {
    cursor: pointer;
 }
</style>
