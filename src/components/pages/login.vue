<template>
  <div class="content">
        <el-row class="main">
        <el-col><h2>登录</h2></el-col>
        <el-col class="form">
            <el-input placeholder="输入账号"  type="text" v-model="form.id"></el-input>
            <el-input placeholder="输入密码"  type="password" v-model="form.password"></el-input>
            <el-row>
            <el-col :span="12"> <el-button type="primary" v-on:click="submit">{{ status ? '正在登录中...' : '登录' }}</el-button></el-col>
            <el-col :span="12">  <el-button type="primary" v-on:click="registery">{{ reg ? '正在发送数据' : '注册' }}</el-button></el-col>
            </el-row>
        </el-col>
        </el-row>
    </div>
</template>

<script>
export default{
  data () {
    return {
      form: {
        user: '123',
        password: ''
      },
      status: false,
      reg: false
    }
  },
  methods: {
    submit () {
      if (!this.form.id) return this.$message({message: '请输入账号', type: 'warning'})
      if (!this.form.password) return this.$message({message: '请输入密码', type: 'warning'})
      this.status = true
      this.$http.post('http://localhost:86/api/login', { id: this.form.id, password: this.form.password }).then((response) => { if (response.status === 200) { location.href = 'http://localhost:8080/#/home' } }, (response) => { if (response.status === 401) { this.$message({message: '帐号密或码不正确:(', type: 'warning'}); this.status = false } }, (response) => { if (response.status === 422) { this.$message({message: '请输入规定格式的字符', type: 'warning'}); this.status = false } }, (response) => { if (response.status === 500) { this.$message({message: '服务器开了个小差-_-!!', type: 'warning'}); this.status = false } })
    },
    registery () {
      if (!this.form.id) return this.$message({message: '请输入账号', type: 'warning'})
      if (!this.form.password) return this.$message({message: '请输入密码', type: 'warning'})
      this.reg = true
    }
  }
}
</script>

<style scoped>
.content{
    width:100vw;
    height:100vh;
    background:url(../../assets/login.jpg);
    background-size: cover;
    background-position: 50% 50% ;
    position: relative;
}
.main {
    background-color: #FFFFFF;
    position: absolute;
    top:50%;
    margin-top: -140px;
    left: 50%;
    margin-left: -250px;
    width: 500px;
    height: 280px;
    border-radius: 10px;
}
.form{
    width: 460px;
    padding: 10px;
}
.el-input{
    padding-top: 10px;
    padding-bottom: 10px;
    margin-left: 20px;
}
.el-button{
    margin-top: 20px;
    height: 45px;
    vertical-align: middle;
}
</style>
