import Api from './api'

export default{
    getWeekDays(param){
        return Api.get('weekday',param)
    },
    addWeekDays(weekday){
        return Api.post('weekday', weekday)
    },
    updateWeekdays(weekday){
        return Api.put(`weekday/${weekday.id}`, weekday)
    }
}