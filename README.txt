https://github.com/eurekasolution/secure

현재 작업 폴더는

c:\xampp\htdocs\secure

로 조정했습니다.


create table member (
    idx int(10) auto_increment,
    id char(20) unique,
    name char(20) ,
    pass char(50),

    primary key(idx)

);

insert into member (id, name, pass)  values('test','테스트', '1111');
insert into member (id, name, pass)  values('admin','관리자', '1111');

javascript:alert(document.cookie)


UNION select '1','2', '3' 'id'


main()
{
    char *ptr;
    ...

    if(ptr)
        value = foo(ptr);

}

int foo(void *ptr)
{
    if(!ptr)
        // check

}

Error Code : Response Code

1xx: Trying
2xx: OK
3xx: Temporary Error, Redirection Error
4xx: Permanent Error, Client Error
5xx: Server Error
6xx: Global Error



OSI-7 Layer

L7 : App
L6 : Pres
L5 : Sess
L4 : Tx
L3 : Network
L2 : DataLink
L1 : Physical

create table board_table (
    idx  int(10) auto_increment,
    title   char(100),
    name    char(30),
    content text,
    primary key(idx)

);
alter table board_table add file char(30);
alter table board_table add fname char(50);


create table log_table (
    idx     int(10) auto_increment,
    ip      char(20),
    work    char(255),
    time    datetime,
    primary key(idx)

);

create table black_table (
    idx     int(10) auto_increment,
    ip      char(20), 
    reject  int(10) default '0',
    time    datetime,
    primary key(idx)
);



&nbsp;
<  : &lt;
>  : &gt;

myscript.jpg%2Ejs

javascript:alert(document.cookie);

STACK CANARY

int main(int argc, char** argv)
{
    char buf[100];

    copy(buf, argv[1]);

    return 1;
}

int copy(char *ptr1,  char* ptr2)
{
    strcpy(ptr1, ptr2);
    return 1;
}

https://archive.org


할 일

    1. 카카오 개발자 사이트 가입
        https://developers.kakao.com/

        원리가 구글지도랑 같아서 카카오지도로 설명예정

    2. 닷홈 무료호스팅 사이트 가입
        카카오지도, 구글지도 등은 localhost에 접속할 수 없어
        무료호스팅이 필요한데,
        저는 닷홈(http://dothome.co.kr)에서 설명할 예정입니다.