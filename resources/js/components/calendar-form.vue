<template>
<div class="form-container">
    <form @submit.prevent="saveEvents()">
        <div class="form-group">
            <label for="my-event">Event</label>
            <input class="form-control " type="text" id="my-event" required v-model="data_form.EventName"></input>
            <div class="date-group">
                <div class="form-group">
                    <label for="date-from">From</label>
                    <v-da
                    <input id="date-from" required type="date" class="form-control" v-model="data_form.DateFrom"/>
                </div>
                <div class="form-group">
                    <label for="date-to">To</label>
                    <input id="date-to" required type="date" class="form-control" v-model="data_form.DateTo"/>
                </div>
            </div>
            <div class="weekdays-group">
                <div class="form-check">
                    <input type="checkbox" id='mon' v-model="data_form.Mon" class="form-check-input"/>
                    <label for="mon">Mon</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id='tue' class="form-check-input" v-model="data_form.Tue"/>
                    <label for="tue">Tue</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id='wed' class="form-check-input" v-model="data_form.Wed"/>
                    <label for="wed">Wed</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id='thu' class="form-check-input" v-model="data_form.Thu"/>
                    <label for="thu">Thu</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id='fri' class="form-check-input" v-model="data_form.Fri">
                    <label for="fri">Fri</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id='sat' class="form-check-input" v-model="data_form.Sat">
                    <label for="sat">Sat</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id='sun' class="form-check-input" v-model="data_form.Sun">
                    <label for="sun">Sun</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <div v-if="loading" class="spinner-border spinner-border-sm"></div>
                <div v-if="!loading">Save</div>
                
            </button>
        </div>
    </form>
    <calendar-list :date_range="date_range" />
</div>
</template>

<script>
import CalendarList from './calendar-list.vue'
import WeekDayApi from '../apis/weekdays'


export default {
    data(){
        return {
            data_form:{
                id:0,
                EventName:'',
                DateFrom:null,
                DateTo:null,
                Mon:false,
                Tue:false,
                Wed:false,
                Thu:false,
                Fri:false,
                Sat:false,
                Sun:false
            },
            date_range:[],
            loading:false,
            showSnackbar:false,
            errors:[]
        }
    },
    components:{
        CalendarList
    },
    methods:{
        isEventToday(current_date){
            const day = current_date.getDay();
            let isEvent = false;
            switch(day){
            case 0:
                if(this.data_form.Sun) isEvent = true;
                break
            case 1:
                if(this.data_form.Mon) isEvent = true;
                break
            case 2:
                if(this.data_form.Tue) isEvent = true;
                break
            case 3:
                if(this.data_form.Wed) isEvent = true;
                break
            case 4:
                if(this.data_form.Thu) isEvent = true;
                break
            case 5:
                if(this.data_form.Fri) isEvent = true;
                break
            case 6:
                if(this.data_form.Sat) isEvent = true;
                break
            }
            return isEvent
        },
        generateDates(){
            if(this.data_form.DateFrom !== null && this.data_form.DateTo !== null){
                let dateFrom = new Date(this.data_form.DateFrom);
                let dateTo = new Date(this.data_form.DateTo);
                this.date_range = []
                for(let d= dateFrom; d<=dateTo; d.setDate(d.getDate()+1)){
                    let xdate = new Date(d);
                    this.date_range.push({cdate:xdate, event:this.isEventToday(xdate)?this.data_form.EventName:null})
                }
            }
        },
        getEvents(params){
            WeekDayApi.getWeekDays().then(response=>{
                if(response.data){
                    this.data_form = response.data
                    this.generateDates();
                }
            })
        },
        saveEvents(){
            this.loading = true
            if(this.data_form.DateFrom !== null && this.data_form.DateTo !== null){
                if(this.data_form.id === 0){
                    WeekDayApi.addWeekDays(this.data_form).then(response=>{
                        if(response.data){
                            this.data_form = response.data
                            this.generateDates()
                        }
                    })
                    .catch((error)=>{
                        if(error.response.status === 422){
                            this.errors = error.response.data.errors;
                            console.log('errors', this.errors);
                        }
                        if(error.response.status === 500){
                            this.errors = error.response.data;
                            console.log('errors', this.errors);
                        }
                        
                    }).finally(()=>{
                        this.loading = false
                    })
                }
                else{
                    WeekDayApi.updateWeekdays(this.data_form).then(response=>{
                        if(response.data){
                            this.data_form = response.data
                            this.event_update = response.data
                            this.generateDates()
                        }
                    })
                    .catch((error)=>{
                        if(error.response.status === 422){
                            this.errors = error.response.data.errors;
                            console.log('errors', this.errors);
                        }
                        if(error.response.status === 500){
                            this.errors = error.response.data;
                            console.log('errors', this.errors);
                        }
                    }).finally(()=>{
                        this.loading = false
                    })
                }
            }
        },
    },
    mounted(){
        this.getEvents();
    }
}
</script>

<style scoped>
.date-group{
    display: flex;
    flex-direction: row;
    margin-top: 10  px;
    justify-content: space-between;
}

.date-group > div{
    width: 48%;
}
.form-container{
    display: flex;
    flex-direction: row;
    width: 100%;
}
form{
    width: 40%;
}
.weekdays-group{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin: 20px 0;
}
</style>
