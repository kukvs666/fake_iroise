<template>
    <div class="d-flex flex-column deux" id="blockDate">
        <div class="d-flex flex-row p-2 header">

            <img src="img/booking/AddCalendar.svg" alt="logo calendrier" class="calendar-svg">
            <p>arrivée</p>
        </div>
        <input type="date" id="selectDate" v-on:change="maj">
        <div class="d-flex flex-row p-2 trois justify-content-center">
            <p class="align-self-center day mb-0">{{ day }}</p>
                <div class="d-flex flex-column p-2 justify-content-center">
                    <p class="mb-0">{{ mounth }}</p>
                    <p class="mb-0">{{ year }}</p>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('component calendar mounted')
        },
        data () {
            return {
                day: 16,
                mounth: 'juillet',
                year: 2019
            }
        },
        methods: {
            maj: function (event) {
                let values = event.target.value.split('-');
                let mounths = {
                    1: "Janvier",
                    2: "Février",
                    3: "Mars",
                    4: "Avril",
                    5: "Mai",
                    6: "Juin",
                    7: "Juillet",
                    8: "Août",
                    9: "Septembre",
                    10: "Octobre",
                    11: "Novembre",
                    12: "Décenbre"
                }
                this.day = parseInt(values[2]);
                this.year = parseInt(values[0]);
                this.mounth = mounths[parseInt(values[1])];

            }
        }
    }
</script>

<style>
    #selectDate {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0px;
        left: 0px;
        opacity: 0;
    }
    #blockDate {
        position: relative;
    }
    #blockDate .header {
        background-color:black;
    }
    .calendar-svg {
        background-color: black;
        width: 40px;
    }
</style>


