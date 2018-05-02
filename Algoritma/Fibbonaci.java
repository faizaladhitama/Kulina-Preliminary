import java.util.ArrayList;
import java.util.Arrays;
import java.util.Scanner;

public class Fibbonaci {
	
	public static void main(String[] args) {
		Scanner in = new Scanner(System.in);
		
		System.out.println("Masukkan input angka :");
		int num = in.nextInt();
		System.out.println("Menampilkan bilangan fibbonaci sampai dengan bilangan input :");
		System.out.println(Arrays.toString(showFibbonaci(num)));
	}
	
	public static int[] showFibbonaci(int num) {
		int[] result;
		if(num > 0){
			result = new int[num];
			Fibbonaci(num,result);
		}else {
			result = new int[1];
		}
		return result;
	}
	
	public static int Fibbonaci(int num, int[] result) {
		if(num == 1 || num == 2) {
			result[num-1] = 1;
			if(num == 2) {
				result[0] = 1;
			}
			return 1; 
		}else {
			int temp = Fibbonaci(num-1, result)+Fibbonaci(num-2, result);
			result[num-1] = temp;
			return temp;
		}
	}
}
