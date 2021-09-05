@extends('layouts.adminLayout')

@section('style')
<style>
    html{ font-size: 1.2rem;}
</style>
    
<script type="text/javascript">
    //When the page loads, all check boxes are unchecked
    function checkOrCancelAll(){
    //1.Get the element object of checkbox
    var chElt=document.getElementById("chElt");
    //2.Get selected state
    var checkedElt=chElt.checked;
    console.log(checkedElt)
    //3.if checked=true,selected all box,checked=false,Cancel all box
    var allCheck=document.getElementsByName("interest");
    //4.Loop through the elements in each check box
    //var mySpan=document.getElementById("mySpan");
    if(checkedElt){
    //choose all
    for(var i=0;i<allCheck.length;i++){
    //Set the checked state of the check box
    allCheck[i].checked=true;
    }
    //mySpan.innerHTML="cancel all";
    }else{
    //cancel all
    for(var i=0;i<allCheck.length;i++){
    allCheck[i].checked=false;
    }
    //mySpan.innerHTML="choose all";
    }
    }
</script>
@endsection

@section('nav-bar')
    <a class="nav-link" href="/login/home">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Home
    </a>
    <a class="nav-link  " href="/login/user">
        <div class="sb-nav-link-icon"><i class="fa fa-user-circle"></i></div>
        User Management
    </a> 
    <a class="nav-link " href="/login/tools">
        <div class="sb-nav-link-icon"><i class="fa fa-suitcase"></i></div>
        Assessment Tools
    </a> 
    <a class="nav-link  " href="/login/request">
        <div class="sb-nav-link-icon"><i class="fa fa-paper-plane"></i></div>
        Pending Tool Request
    </a>
    <a class="nav-link " href="/login/todolist">
        <div class="sb-nav-link-icon"><i class="fa fa-server"></i></div>
        To-do List 
    </a> 
    <a class="nav-link bg-primary text-white" href="/login/feedback">
        <div class="sb-nav-link-icon"><i class="fa fa-life-ring"></i></div>
        Feedback
    </a> 
    <a class="nav-link" href="/login/draft">
        <div class="sb-nav-link-icon"> <i class="fab fa-firstdraft"></i> </div>
        Draft
    </a>
@endsection

@section('content')
    <main>
        <h1 class="display-5">Feedback</h1>
        <div class="row">
            <!--Add new tool button-->
            <div class="col-sm-4">

                <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                data-bs-target="#createToolForm"><i class="fas fa-trash"></i> Delete</button>   
            </div>

            <div class="col-sm-3"></div>

        </div>


        <!--Table List-->
        <div class="container-fluid mt-2 p-0">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"><input type="checkbox" id="chElt" onclick="checkOrCancelAll();"></th>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tool Name</th>
                        <th scope="col">Health Domain</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    <tr data-bs-toggle="collapse" data-bs-target="#hidden">
                        
                        <th scope="row" >
                            <input type="checkbox" name="interest"/>
                        </th>  
                        <td>1</td>
                        <td class="col-sm-2">John Doe</td>
                        <td>person1@gmail.com
                        <td class="col-sm-3">The Resilience Questionnaire</td>
                        <td>Emotional</td>
                        <td>2/7/2021</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary p-0 border shadow text-white" colspan="9">
                            <div id="hidden" class="collapse mt-2 mb-2">
                                <div class="row">
                                <div class="col-sm-3 text-center">Content</div>
                                <div class="col-sm-9">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est, aperiam, necessitatibus placeat dignissimos numquam deserunt, voluptatum laboriosam similique nobis dolorum ea! Laborum, molestias? Id ducimus exercitationem aut debitis sint quo?
                                </div>
                                </div>
                            </div>
                        </td>    
                    </tr>
                    
                    <tr data-bs-toggle="collapse" data-bs-target="#hidden2">
                        
                        <th scope="row" >
                            <input type="checkbox" name="interest"/>
                        </th>  
                        <td>2</td>
                        <td class="col-sm-2">John Doe</td>
                        <td>person2@gmail.com
                        <td class="col-sm-3">The Resilience Questionnaire</td>
                        <td>Emotional</td>
                        <td>8/6/2021</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary p-0 border shadow text-white" colspan="9">
                            <div id="hidden2" class="collapse mt-2 mb-2">
                                <div class="row">
                                <div class="col-sm-3 text-center">Content</div>
                                <div class="col-sm-9">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est, aperiam, necessitatibus placeat dignissimos numquam deserunt, voluptatum laboriosam similique nobis dolorum ea! Laborum, molestias? Id ducimus exercitationem aut debitis sint quo?
                                </div>
                                </div>
                            </div>
                        </td>    
                    </tr>
                    
                    <tr data-bs-toggle="collapse" data-bs-target="#hidden3">
                        
                        <th scope="row" >
                            <input type="checkbox" name="interest"/>
                        </th>  
                        <td>3</td>
                        <td class="col-sm-2">John Doe</td>
                        <td>person3@gmail.com
                        <td class="col-sm-3">The Resilience Questionnaire</td>
                        <td>Emotional</td>
                        <td>3/6/2021</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary p-0 border shadow text-white" colspan="9">
                            <div id="hidden3" class="collapse mt-2 mb-2">
                                <div class="row">
                                <div class="col-sm-3 text-center">Content</div>
                                <div class="col-sm-9">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est, aperiam, necessitatibus placeat dignissimos numquam deserunt, voluptatum laboriosam similique nobis dolorum ea! Laborum, molestias? Id ducimus exercitationem aut debitis sint quo?
                                </div>
                                </div>
                            </div>
                        </td>    
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!--Table List-->
    </main>
@endsection