    <script>
        function checkError()
        {
            let id = document.querySelector('#secureid');
            //alert(id);
            // [^abc]
            let regexp = /[-\s]+/;
            if(!regexp.test(id.value))
            {
               
            }else
            {
                alert('하이픈과 스페이스바는 입력할 수 없습니다');
                id.focus();
                return false;
            }

            // 아이디와 비번 저장하기가 체크되어 있으면, 쿠키 저장하기
            let secureid = document.querySelector('#secureid').value;
            let securepass = $('#securepass').val();
        
            let idsave = $('#idsave').is(':checked');
            let passsave = $('#passsave').is(':checked');

            if(idsave == true)
            {
                //alert('id save');
                setCookie('secureid', secureid, 31);
            }
            else  
                setCookie('secureid', secureid, 0);

            if(passsave == true)
            {
                alert('비밀번호가 저장되고 있습니다.\n개인 PC가 아니면 반드시 확인하세요.');
                setCookie('securepass', securepass, 31);
            }              
            else  
                setCookie('securepass', securepass, 0);

            // 암호화된 값으로 만들어서 보낸다.    
            
            //document.querySelector('#securepass').value = CryptoJS.MD5(securepass).toString();

        }
    </script>
    
    <form method="post" action="login.php" onSubmit="return checkError()">
    <div class="row">
        <div class="col-2 text-center">ID 
            <input type="checkbox" name="idsave" id="idsave">
        </div>
        <div class="col">
            <input type="text" name="secureid" id="secureid" required placeholder="아이디" class="form-control">
        </div>

        <div class="col-2 text-center">PW
            <input type="checkbox" name="passsave" id="passsave">
        </div>
        <div class="col">
            <input type="password" name="securepass" id="securepass" class="form-control">
        </div>
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">로그인</button>    

        </div>
    </div>
    </form>

    <script>
        getCookieIfSaveOld();
    </script>