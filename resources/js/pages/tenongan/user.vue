<template>
  <div class="row">
    <div class="col">
      <card :title="'User'">
        {{ 'ini halaman User' }}
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
    return { title: "User" }
  }
}
</script>
