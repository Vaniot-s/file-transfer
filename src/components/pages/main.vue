<template>
    <div>
        <el-row :gutter="30">
            <el-col :span="17">
                <el-container>
                    <el-header>文件传输助手</el-header>
                    <el-main>
                        <el-row id="list">
                            <el-col :span="4">文件名</el-col>
                            <el-col :span="4">修改时间</el-col>
                            <el-col :span="4">大 小</el-col>
                            <el-col :span="4">下 载</el-col>
                            <el-col :span="4">删 除</el-col>
                            <el-col :span="4">分 享</el-col>
                        </el-row>
                        <el-row id="list">
                            <el-col :span="4">文件名称</el-col>
                            <el-col :span="4">修改时间</el-col>
                            <el-col :span="4">上传者</el-col>
                            <el-col :span="4">大 小</el-col>
                            <el-col :span="4">操 作</el-col>
                            <el-col :span="4">操 作</el-col>
                        </el-row>
                        <el-row id="list">
                            <el-col :span="4">文件名称</el-col>
                            <el-col :span="4">修改时间</el-col>
                            <el-col :span="4">上传者</el-col>
                            <el-col :span="4">大 小</el-col>
                            <el-col :span="4">操 作</el-col>
                            <el-col :span="4">操 作</el-col>
                        </el-row>
                    </el-main>
                </el-container>
            </el-col >
            <el-col :span="7">
                <el-container>
                    <el-header>好友列表</el-header>
                    <el-main>
                        <el-row id="friends">
                            <el-col>xxxx[online]</el-col>
                            <el-col>xxxx[offline]</el-col>
                            <el-col>xxxx</el-col>
                        </el-row>
                    </el-main>
                </el-container>
            </el-col>
        </el-row>
    </div>
</template>
<script>

</script>

<style scoped>
 .el-row {
    margin: 60px 20px 60px !important;
  }
  #list {
    margin: 0px !important;
    text-align: center;
    font: bolder 20px;
  }
  .el-container{
    border-radius: 8px;
  }
  .el-header {
    background-color: #409EFF;
    color: white;
    text-align: center;
    line-height: 60px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
  }
  .el-main{
    border:solid 1px gray;
    border-top: none;
    border-shadow: 0 0 5px rgba(0,0,0,0.25);
  }
  #friends {
    margin: 20px !important;
  }
</style>
