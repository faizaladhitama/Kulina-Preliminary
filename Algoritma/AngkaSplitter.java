import java.util.Arrays;
import java.util.Scanner;

public class AngkaSplitter {
	
	public static void main(String[] args) {
		Scanner in = new Scanner(System.in);
		
		System.out.println("Masukkan input angka :");
		long num = in.nextLong();
		System.out.println("Output :");
		showSplitter(num);
	}

	public static void showSplitter(long num) {
		String parsed = ""+num;
		String zeros = "";
		for(int i = 0; i < parsed.length()-1; i++) {
			zeros += "0";
		}
		
		System.out.println(parsed);
		for(int j = 0; j < parsed.length(); j++) {
			String result = parsed.substring(j,j+1)+zeros.substring(j);
			System.out.println(result);
		}
	}
}
