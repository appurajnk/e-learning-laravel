<template>
  <form @submit.prevent="enroll">
    <base-button :loading="form.busy" class="btn btn-danger rounded-0 btn-block">
      <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
      {{ trans('strings.enroll_now') }}
    </base-button>    
  </form>
</template>

<script>
import Form from 'vform'
export default {
  props: {
    courses: { type: [Object, Array] },
    source: { type: String, default: 'cart' }
  },
  
  data(){
    return{
      form: new Form({
        courses: []
      })  
    }
  },

  computed:{
    course_list(){
      if(this.source == 'cart'){
        return this.courses.map(c => c.product.uuid)
      } else {
        return [this.courses.uuid]
      }
    }
  },
  
  methods: {
    async enroll(){
      this.form.courses = await this.course_list
      await this.form.post(`/api/cart/enroll-now`)
        .then(() => {
          window.location.href=`/home/my-courses/learning`
        })
    }
  }
}
</script>