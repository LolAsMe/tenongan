<template>
  <div class="row">
    <div class="col">
      <card :title="'Pedagang'">
        {{ 'ini halaman Pedagang' }}
      </card>
    </div>
  </div>
</template>

<script>
// import axios from 'axios'
export default {
  middleware: 'auth',

  // async asyncData () {
  //   const { data: projects } = await axios.get('/api/projects')

  //   return {
  //     projects
  //   }
  // },

  metaInfo () {
    return { title: "Pedagang" }
  }
}
</script>
