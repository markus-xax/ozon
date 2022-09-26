<template>
  <v-card
      class="enter pa-md-5 pa-sm-2 pa-xs-2 pa-lg-10 pa-xl-10 login-card"
      :loading="loading"
      rounded
  >
    <v-form
      class="login-form"
      ref="loginForm"
    >
      <v-row>
        <v-col>
          <v-text-field
              v-model="login"
              required
              :loading="loading"
              type="text"
              label="Логин"
              placeholder="Логин"
              clearable
              prepend-icon="mdi-account"
              :rules="rules.login"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-text-field
              v-model="password"
              label="Пароль"
              required
              :loading="loading"
              placeholder="Пароль"
              :type="passwordInputType"
              prepend-icon="mdi-lock"
              append-icon="mdi-eye"
              @click:append="passwordVisible = !passwordVisible"
              :rules="rules.password"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-btn
            class="mb-5"
            @click="onSubmit"
            :loading="loading"
            width="100%"
            height="70"
        >
          Войти
        </v-btn>
      </v-row>
      <v-card-text
      ></v-card-text>
    </v-form>
    <v-snackbar
        v-if="notify"
        v-model="notify"
    >{{ notificationText }}</v-snackbar>
  </v-card>
</template>

<script>
export default {
  name: 'Login',
  data: () => ({
    loading: false,
    login: '',
    password: '',
    passwordVisible: false,
    notify: false,
    notificationText: ''
  }),
  methods: {
    async onSubmit () {
      const valid = await this.$refs.loginForm.validate().then((response) => {
        return response.valid
      })

      if (valid) {
        this.loading = true
        let that = this
        await this.authorize({
          login: this.login,
          password: this.password
        }).then((response) => {
          if (response.ok) {
            this.$router.push({name: 'default'})
          } else {
            this.notify = true
            this.notificationText = response.error
          }
        }).catch((error) => {
          this.notify = true
          this.notificationText = error.error
        }).finally(() => {
          this.loading = false
        })
      }
    },
    async authorize (fields) {
      return await this.$axios.postForm('/', fields)
        .then((response) => {
          console.log('responseDataAxios', response.data)
          if (! response.data) throw new Error(response.statusText)
          return {...{ok: true}, ...response}
        }).catch((error) => {
          console.log('errorAxios', error)
          return {
            status: error.response.status,
            ok: false,
            error: error.message,
            code: error.code
          }
          // return error
        })
    }
  },
  computed: {
    passwordInputType () {
      const result = (this.passwordVisible ? 'text' : 'password')
      return result
    },
    rules () {
      return {
        login: [
            v => !!v || 'Поле обязательно для заполнения',
            v => ((v.length >= 3) || 'Минимальная длина 3 символа')
        ],
        password: [
            v => !!v || 'Поле обязательно для заполнения',
            v => ((v.length >= 5) || 'Минимальная длина 5 символов')
        ]
      }
    }
  }
}
</script>
