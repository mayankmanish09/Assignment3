package Statistics;

import java.util.Arrays;

public class node {
	
	public int edges[];
	public int no_edges;
	public String location;
	public int cluster_no;
	public int dost_ke_dost[],freq[],kitne;
	public int arr[];
	public String topics[] ;
	public int topic_freq[],no_topics;
	public int suggest[];
	
	node(){
		edges=new int[100];
		dost_ke_dost=new int[20000];
		topics=new String[300];
		topic_freq=new int[300];
		kitne=0;
		no_edges=0;
		cluster_no=0;
		
	}
	node(int max){
		edges=new int[max];
		no_edges=0;
		cluster_no=0;
		dost_ke_dost=new int[20000];
		topics=new String[300];
		topic_freq=new int[300];
		
		kitne=0;
	}
	
	public void reducto(){
		arr=new int[2500]; 	//(Very safe!!!)
		freq=new int[2500];
		int arr_size=0;
		
		for (int i=0 ;i< kitne; i++){
			int temp=dost_ke_dost[i];
			int flag=0;
			
			for (int j=0; j<arr_size;j++){
				if (arr[j]==temp)	{ 
						flag =1;
						freq[j]++;
						j=arr_size;//loop ender
						
				}
			}
			
			if (flag==0) arr[arr_size++]=temp;
				
		}//i loop
		
		dost_ke_dost=Arrays.copyOf(arr, arr_size);
		kitne=arr_size;
		
		//System.out.println("pppppppppppp"+no_edges);
	}
	
	
	
	
}

