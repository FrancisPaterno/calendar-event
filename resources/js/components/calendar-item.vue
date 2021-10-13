<template>
<div>
  <div :class="[current_date.event? 'selectedEvent': '', ' item-container']">
    <div class="box-1">{{current_date.cdate.getDate()}}</div>
    <div class="box-2">{{getDayOfWeek}}</div>
    <div class="box-3" v-show="current_date.event">{{current_date.event}}</div>
  </div>
  <hr/>
</div>
</template>

<script>
export default {
    props:['current_date'],
    methods:{
      getStrDay(day){
        let strDay = ''
        switch(day){
          case 0:
            strDay = 'Sun'
            break
          case 1:
            strDay = 'Mon'
            break
          case 2:
            strDay = 'Tue'
            break
          case 3:
            strDay = 'Wed'
            break
          case 4:
            strDay = 'Thu'
            break
          case 5:
            strDay = 'Fri'
            break
          case 6:
            strDay = 'Sat'
            break
        }
        return strDay
      }
    },
    computed:{
      getDayOfWeek(){
        const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
        return days[this.current_date.cdate.getDay()] 
      },
    }
}
</script>

<style scoped>
  .item-container{
    display: flex;
    flex-direction: row;
    margin: 0px;
    padding: 5px 0;
  }

  hr{
     color: gray; border-style: inset; border-width: 1px; margin: 0; padding: 0;
  }

  .active{
    display: block;
    
  }

  .inactive{
    display: none;
  }

  .selectedEvent{
    background-color: #dff7e1
  }

  .box-1{
    width: 20px;
    margin: 0 0 0 20px;
  }

  .box-2{
    margin: 0 4px;
  }
  
  .box-3{
    text-align: center;
    margin: 0 150px;
  }
</style>