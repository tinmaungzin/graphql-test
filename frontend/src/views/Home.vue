<template>
  <div class="home">

      <ApolloQuery :query="require('@/graphql/queries/users.gql')" :variables="{ limit: limit, page: page }">
          <template slot-scope="{ result: { data, loading },isLoading }">
              <div v-if="isLoading">Loading...</div>
              <table v-else class="table table-bordered">
                  <thead class="thead-dark">
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="user of data.users.data" :key="user.id">
                      <th scope="row">{{user.id}}</th>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>
                          <router-link :to="{ name: 'Show', params: {id: user.id } }">View</router-link>

                      </td>
                  </tr>
                  </tbody>
              </table>
              <nav aria-label="Page navigation example">
                  <ul class="pagination">
                      <li v-for="index in parseInt(data.users.total/limit)+1 "  :key="index" class="page-item"><a @click="setPage(index)" class="page-link" href="#">{{index}}</a></li>
                  </ul>
              </nav>
          </template>
      </ApolloQuery>
  </div>
</template>

<script>
export default {
  name: 'Home',
    data(){
        return{
            users: [],
            userId: null,
            limit: 2,
            page: 1,
            pageIndex: 1,
        }
    },
    methods: {
        setPage(page){
            this.page = page;
        },
        onDone(){
            this.$router.push('/')
        }
    },

}
</script>
