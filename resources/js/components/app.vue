<template>
  <div class="container">
    <div class="card-title">
      Calendar
    </div>
    <hr/>
    <div class="card-body">
      <calendar-form/>
    </div>
  </div>
</template>
<script>
import CalendarForm from './calendar-form.vue'

export default {
  components:{
    CalendarForm
  }
}
</script>
<style scoped>
  .container{
    margin: 10px auto;
    width: 100vmax;
    height: 100%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    border-radius: 10px;
    display: flex;
    flex-direction: column;
  }

  hr{
     color: gray; border-style: inset; border-width: 1px; margin: 0.5em 0;
  }

  .card-title{
    font-weight: bold;
    font-size: large;
    text-align: left;
    margin: 20px 15px 10px;
  }
  
</style>