<template>
    <div class="list-container">
        <div v-for="(idate, index) in date_range" :key="index" >
            <div v-if="getDateMonthYear(idate)">
                <div class="list-title">{{getTitle(idate)}}</div>
                <hr/>
            </div>
            <calendar-item :current_date="idate"></calendar-item>
        </div>
    </div>
</template>

<script>
import CalendarItem from './calendar-item.vue'
const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
]
let xMonth = ''

export default {
    props:['date_range'],
    data(){
        return { 
        }
    },
    components:{
        CalendarItem
    },
    computed:{
        
    },
    methods:{
        getTitle(idate){
            return `${monthNames[idate.cdate.getMonth()]} ${idate.cdate.getFullYear()}`
        },

        getDateMonthYear(idate){
            let curMonth = monthNames[idate.cdate.getMonth()]
            let res = true
            console.log(xMonth, curMonth)
            if(xMonth !== curMonth){
                res = true;
                xMonth = curMonth
            }
            else{
                res = false
            }
            return res
        }
    },
    watch:{
        date_range(){
            xMonth = ''
        }
    }
}
</script>

<style scoped>
    .list-container{
        display: flex;
        flex-direction: column;
        width: 60%;
        height: 100vh;
        margin: 0 20px;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .list-title{
        font-size:xx-large;
        font-weight: bold;
    }

    .event-list{
        position: relative;
        display: flex;
        flex-direction: column;
        width: auto;
        height: 60%;
    }

    hr{
     color: gray; border-style: inset; border-width: 1px; margin: 0 0;
    }
</style>