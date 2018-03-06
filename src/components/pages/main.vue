<template>
    <div>
        <el-row :gutter="30">
            <el-col :span="16">
                <el-container>
                    <el-header>文件传输助手</el-header>
                    <el-main>Main</el-main>
                </el-container>
            </el-col >
            <el-col :span="6">
                <el-container>
                    <el-header>好友列表</el-header>
                    <el-main>Main</el-main>
                </el-container>
            </el-col>
        </el-row>
    </div>
</template>
<script>
</script>

<style>
 .el-row {
    margin: 60px 20px 60px !important;
  }
  .el-container{
    border: black 1px solid;
    border-radius: 8px;
  }
  .el-header {
    background-color: #409EFF;
    color: white;
    text-align: center;
    line-height: 60px;
  }
</style>
